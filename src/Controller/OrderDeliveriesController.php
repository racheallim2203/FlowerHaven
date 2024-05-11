<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Entity\OrderDelivery;
use Cake\Datasource\ConnectionManager;
use Cake\Log\Log;
use Cake\Mailer\Mailer;
use Cake\ORM\TableRegistry;
use DateTime;
use Exception;

/**
 * OrderDeliveries Controller
 *
 * @property \App\Model\Table\OrderDeliveriesTable $OrderDeliveries
 * @property \App\Model\Table\PaymentsTable $Payments
 *  *  @property \App\Model\Table\UsersTable $Users
 * @property \App\Model\Table\FlowersTable $Flowers
 * @property \App\Model\Table\PaymentMethodsTable $PaymentMethods
 *  *  @property \App\Model\Entity\Payment $Payment
 */
class OrderDeliveriesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $result = $this->Authentication->getResult();
        $userIsAdmin = $result->getData()->isAdmin;

        if ($userIsAdmin == 0) {
            $this->response = $this->response->withStatus(401);
            $this->viewBuilder()->setTemplatePath('Error');
            $this->viewBuilder()->setTemplate('error401');
            $this->render();
            return;
        }

        // Proceed with orderdeliveries index function
        $query = $this->OrderDeliveries->find()
            ->contain(['OrderStatuses', 'DeliveryStatuses'])
            ->order([
                'CASE WHEN DeliveryStatuses.delivery_status = \'Awaiting Pickup\' THEN 0 ELSE 1 END' => 'ASC',
                'OrderDeliveries.id' => 'ASC'
            ]);

        $orderDeliveries = $this->paginate($query);

        $this->set(compact('orderDeliveries'));
    }

    /**
     * View method
     *
     * @param string|null $id Order Delivery id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view(?string $id = null)
    {
        // Get the current user's ID and details
        $result = $this->Authentication->getResult();
        $userIsAdmin = $result->getData()->isAdmin;

        // Check if the current user is an admin
        if ($userIsAdmin == 0) {
            // Render the custom error401 page if the user is not an admin
            $this->response = $this->response->withStatus(401);
            $this->viewBuilder()->setTemplatePath('Error');
            $this->viewBuilder()->setTemplate('error401');
            $this->render();
            return;
        }

        try {
            // Retrieve the order delivery with related entities including OrderFlowers and Flowers
            $orderDelivery = $this->OrderDeliveries->get($id, [
                'contain' => [
                    'OrderStatuses',
                    'DeliveryStatuses',
                    'Payments' => [
                        'PaymentStatuses',
                        'PaymentMethods',
                        'Users'
                    ],
                    'OrderFlowers' => [
                        'Flowers'  // Make sure the association is set to retrieve details about flowers
                    ]
                ]
            ]);
        } catch (\Cake\Datasource\Exception\RecordNotFoundException $e) {
            // Handle the case where the order delivery does not exist
            $this->Flash->error(__('Order delivery not found.'));
            return $this->redirect(['action' => 'index']);
        }

        $this->set(compact('orderDelivery'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $orderDelivery = $this->OrderDeliveries->newEmptyEntity();
        if ($this->request->is('post')) {
            $orderDelivery = $this->OrderDeliveries->patchEntity($orderDelivery, $this->request->getData());
            if ($this->OrderDeliveries->save($orderDelivery)) {
                $this->Flash->success(__('The order delivery has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order delivery could not be saved. Please, try again.'));
        }
        $orderstatuses = $this->OrderDeliveries->OrderStatuses->find('list', ['limit' => 200])->all();
        $deliveryStatuses = $this->OrderDeliveries->DeliveryStatuses->find('list', limit: 200)->all();
        $this->set(compact('orderDelivery', 'orderstatuses', 'deliveryStatuses'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Order Delivery id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit(?string $id = null)
    {
        // Authentication and admin check
        $result = $this->Authentication->getResult();
        $userIsAdmin = $result->getData()->isAdmin;

        if ($userIsAdmin == 0) {
            $this->response = $this->response->withStatus(401);
            $this->viewBuilder()->setTemplatePath('Error');
            $this->viewBuilder()->setTemplate('error401');
            $this->render();
            return;
        }

        $orderDelivery = $this->OrderDeliveries->get($id, [
            'contain' => ['OrderStatuses', 'DeliveryStatuses'],
        ]);

        $orderstatuses = $this->OrderDeliveries->OrderStatuses->find('list', [
            'keyField' => 'id',
            'valueField' => 'order_type',
        ])->toArray();

        $deliveryStatuses = $this->OrderDeliveries->DeliveryStatuses->find('list', [
            'keyField' => 'id',
            'valueField' => 'delivery_status',
        ])->toArray();

        $isCancelled = ($orderDelivery->order_status && $orderDelivery->order_status->order_type === 'Cancelled');

        if ($this->request->is(['patch', 'post', 'put'])) {
            $orderDelivery = $this->OrderDeliveries->patchEntity($orderDelivery, $this->request->getData());
            if ($this->OrderDeliveries->save($orderDelivery)) {
                $this->Flash->success(__('The order delivery has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order delivery could not be saved. Please, try again.'));
        }
        $this->set(compact('orderDelivery', 'orderstatuses', 'deliveryStatuses', 'isCancelled'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Order Delivery id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete(?string $id = null)
    {
        // Get the current user's ID and details
        $result = $this->Authentication->getResult();
        $userIsAdmin = $result->getData()->isAdmin;

        // Check if the current user is an admin
        if ($userIsAdmin == 0) {
            // Render the custom error401 page if the user is not an admin
            $this->response = $this->response->withStatus(401);
            $this->viewBuilder()->setTemplatePath('Error');
            $this->viewBuilder()->setTemplate('error401');
            $this->render();
        }

        // Proceed with orderdeliveries delete function
        $this->request->allowMethod(['post', 'delete']);
        $orderDelivery = $this->OrderDeliveries->get($id);
        if ($this->OrderDeliveries->delete($orderDelivery)) {
            $this->Flash->success(__('The order delivery has been deleted.'));
        } else {
            $this->Flash->error(__('The order delivery could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function processOrder()
    {
        $this->autoRender = false;
        $session = $this->request->getSession();
        $cart = $session->read('Cart');
        if (empty($cart)) {
            return $this->responseJson(['success' => false, 'message' => 'Your cart is empty.']);
        }

        $flowersTable = TableRegistry::getTableLocator()->get('Flowers');
        $paymentsTable = TableRegistry::getTableLocator()->get('Payments');
        $orderFlowersTable = TableRegistry::getTableLocator()->get('OrderFlowers');
        $connection = ConnectionManager::get('default');
        $connection->begin();

        try {
            $totalAmount = array_sum(array_map(function ($item) {
                return $item['quantity'] * $item['price'];
            }, $cart));

            $orderDelivery = $this->OrderDeliveries->newEntity([
                'orderstatus_id' => 'ORS-00001',
                'deliverystatus_id' => 'DEL-00001',
                'order_date' => date('Y-m-d'),
                'total_amount' => $totalAmount,
                'delivery_date' => (new DateTime())->modify('+5 days')->format('Y-m-d'),
            ]);

            if ($this->OrderDeliveries->save($orderDelivery)) {
                // Fetch the last order with the highest custom ID
                $lastOrderDelivery = $this->OrderDeliveries->find()
                    ->select(['id'])
                    ->order(['id' => 'DESC'])  // Order by ID in descending order to get the latest one
                    ->first();

                if ($lastOrderDelivery) {
                    // Extract the ID from the entity
                    $orderDeliveryId = $lastOrderDelivery->id;

                    // Output or log the extracted ID
                    $this->log('Retrieved orderDeliveryId: ' . $orderDeliveryId, 'debug');
                } else {
                    // Log error or handle the case where no entity was found
                    $this->log('No order delivery was found to extract ID.', 'debug');
                    throw new Exception('No order delivery was found to extract ID.');
                }
            }
            $result = $this->Authentication->getResult();
            $userId = $result->getData()->id;
            $this->log('Retrieved orderDeliveryId: ' . $userId, 'debug');
            $this->log('Retrieved orderDeliveryId: ' . $orderDeliveryId, 'debug');
            $paymentData = [
                'orderdelivery_id' => $orderDeliveryId,
                'paymentstatus_id' => 'PAS-00001',
                'paymentmethod_id' => $this->request->getData('payment_method_id'),

                'user_id' => $userId,
            ];



            // Create a new entity for Payments
            $payment = $paymentsTable->newEntity($paymentData);
            $this->log('Retrieved orderDeliveryId: ' . $orderDeliveryId, 'debug');
            // Attempt to save the entity to the database
            if (!$paymentsTable->save($payment)) {
                $this->log('Failed to save payment details. Errors: ' . json_encode($payment->getErrors()), 'debug');
                throw new Exception('Unable to save payment details.');
            } else {
                $paymentId = $payment->id;  // Successfully saved
                $this->log('Successfully saved payment details. Payment ID: ' . $paymentId, 'debug');
            }
            $this->log('Retrieved orderDeliveryId: ' . $orderDeliveryId, 'debug');
            foreach ($cart as $item) {
                try {
                    $this->log('Retrieved orderDeliveryId: ' . $orderDeliveryId, 'debug');
                    $flower = $flowersTable->get($item['flower_id']);
                    $orderflowerData = [
                        'flower_id' => $flower->id,
                        'orderdelivery_id' => $orderDeliveryId,
                        'quantity' => $item['quantity']
                    ];

                    $orderFlower = $orderFlowersTable->newEntity($orderflowerData);
                    if (!$orderFlowersTable->save($orderFlower)) {
                        throw new Exception('Failed to save order detail for flower.');
                    }
                } catch (RecordNotFoundException $e) {
                    Log::error('Flower not found with ID: ' . $item['flower_id']);
                    continue; // Skip this item or handle accordingly
                }
            }
            $this->log('Retrieved orderDeliveryId: ' . $orderDeliveryId, 'debug');
            // Reduce stock count once successful payment made
            foreach ($cart as $item) {
                $flower = $flowersTable->get($item['flower_id']);
                if ($flower->stock_quantity < $item['quantity']) {
                    throw new Exception('Not enough stock for some items.');
                }
                $flower->stock_quantity -= $item['quantity'];
                if (!$flowersTable->save($flower)) {
                    throw new Exception('Unable to update stock for flower ID: ' . $item['flower_id']);
                }

            }
            $this->log('Retrieved orderDeliveryId: ' . $orderDeliveryId, 'debug');
//            // Attempt to send confirmation email
//            $this->sendConfirmationEmail($cart);

            // Proceed with the rest of the transaction handling
            $connection->commit();
            $session->delete('Cart');
            $this->log('Retrieved orderDeliveryId: ' . $orderDeliveryId, 'debug');
            return $this->responseJson([
                'success' => true,
                'message' => 'Payment processed successfully',
                'orderDeliveryId' => $orderDeliveryId,
                'paymentId' => $paymentId,
            ]);
        } catch (Exception $e) {
            // Log the exception message to understand what went wrong
            Log::debug('Error processing order: ' . $e->getMessage());
            $connection->rollback();

            return $this->responseJson(['success' => false, 'message' => 'Error processing your order: ' . $e->getMessage()]);
        }
    }

    private function responseJson($data)
    {
        $this->autoRender = false;
        // Always return a response object
        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($data));
    }
}
