<?php
declare(strict_types=1);

namespace App\Controller;

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
        $query = $this->OrderDeliveries->find()
            ->contain(['OrderStatuses', 'DeliveryStatuses']);
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
        $orderDelivery = $this->OrderDeliveries->get($id, contain: ['Orderstatuses', 'DeliveryStatuses']);
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
        $orderDelivery = $this->OrderDeliveries->get($id, [
            'contain' => [],
        ]);

        $orderstatuses = $this->OrderDeliveries->OrderStatuses->find('list', [
            'keyField' => 'id',
            'valueField' => 'order_type',
        ])->toArray();

        $deliveryStatuses = $this->OrderDeliveries->DeliveryStatuses->find('list', [
            'keyField' => 'id',
            'valueField' => 'delivery_status',
        ])->toArray();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $orderDelivery = $this->OrderDeliveries->patchEntity($orderDelivery, $this->request->getData());
            if ($this->OrderDeliveries->save($orderDelivery)) {
                $this->Flash->success(__('The order delivery has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order delivery could not be saved. Please, try again.'));
        }
        $this->set(compact('orderDelivery', 'orderstatuses', 'deliveryStatuses'));
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
            $this->log('Retrieved orderDeliveryId: ' . $orderDeliveryId, 'debug');
            $paymentData = [
                'orderdelivery_id' => $orderDeliveryId,
                'paymentstatus_id' => 'PAS-00001',
                'paymentmethod_id' => $this->request->getData('payment_method_id'),
                'user_id' => $userId,
            ];


            // Create a new entity for Payments
            $payment = $paymentsTable->newEntity($paymentData);

            // Attempt to save the entity to the database
            if (!$paymentsTable->save($payment)) {
                throw new Exception('Unable to save payment details.');
            } else {
                $paymentId = $payment->id;  // Successfully saved
            }

            foreach ($cart as $item) {
                try {
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

//            // Attempt to send confirmation email
//            $this->sendConfirmationEmail($cart);

            // Proceed with the rest of the transaction handling
            $connection->commit();
            $session->delete('Cart');

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
