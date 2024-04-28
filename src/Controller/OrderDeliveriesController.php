<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Datasource\ConnectionManager;
use DateTime;
use Exception;
use Cake\ORM\TableRegistry;
use Cake\Log\Log;

/**
 * OrderDeliveries Controller
 *
 * @property \App\Model\Table\OrderDeliveriesTable $OrderDeliveries
 *  @property \App\Model\Table\PaymentsTable $Payments
 *  *  @property \App\Model\Table\UsersTable $Users
 * @property \App\Model\Table\FlowersTable $Flowers
 *  @property \App\Model\Table\PaymentMethodsTable $PaymentMethods
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
    public function view($id = null)
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
    public function edit($id = null)
    {
        $orderDelivery = $this->OrderDeliveries->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
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
     * Delete method
     *
     * @param string|null $id Order Delivery id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
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
                // If the ID isn't being set automatically, fetch it explicitly
                $freshOrderDelivery = $this->OrderDeliveries->find()
                    ->select(['id'])
                    ->where(['order_date' => $orderDelivery->order_date, 'total_amount' => $orderDelivery->total_amount])
                    // You might want to use more specific conditions to ensure uniqueness
                    ->first();
                if ($freshOrderDelivery) {
                    $orderDeliveryId = $freshOrderDelivery->id;
                } else {
                    throw new Exception('Failed to retrieve order delivery ID.');
                }
            }

//            // Retrieve user_id from the session
//            $user_id = $this->request->getSession()->read('user_id');
//            if (!$user_id) {
//                return $this->responseJson(['success' => false, 'message' => 'User not logged in.']);
//            }

            $paymentData = [
                'orderdelivery_id' => $orderDeliveryId,
                'paymentstatus_id' => 'PAS-00001',
                'paymentmethod_id' =>  $this->request->getData('payment_method_id'),
                'user_id' => 'USE-00003',
            ];

            $payment = $paymentsTable->newEntity($paymentData);
            if (!$paymentsTable->save($payment)) {
                throw new Exception('Unable to save payment details.');
            } else {
                $paymentId = $payment->id;  // Make sure this is after a successful save
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

            // Proceed with the rest of the transaction handling
            $connection->commit();
            $session->delete('Cart');
            return $this->responseJson([
                'success' => true,
                'message' => 'Payment processed successfully',
                'orderDeliveryId' => $orderDeliveryId,
                'paymentId' => $paymentId
            ]);

        }catch (Exception $e) {
                // Log the exception message to understand what went wrong
                Log::debug('Error processing order: ' . $e->getMessage());
                $connection->rollback();
                return $this->responseJson(['success' => false, 'message' => 'Error processing your order: ' . $e->getMessage()]);
        }
    }
    private function responseJson($data) {
        $this->autoRender = false;
        // Always return a response object
        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($data));
    }



}
