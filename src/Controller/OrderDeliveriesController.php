<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Datasource\ConnectionManager;
use DateTime;
use Exception;

/**
 * OrderDeliveries Controller
 *
 * @property \App\Model\Table\OrderDeliveriesTable $OrderDeliveries
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
        $orderstatuses = $this->OrderDeliveries->Orderstatuses->find('list', limit: 200)->all();
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
        $orderstatuses = $this->OrderDeliveries->Orderstatuses->find('list', limit: 200)->all();
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
        $session = $this->request->getSession();
        $cart = $session->read('Cart');

        if (empty($cart)) {
            $this->Flash->error(__('Your cart is empty.'));
            return $this->redirect(['controller' => 'Pages', 'action' => 'display', 'home']);
        }

        $connection = ConnectionManager::get('default');
        $connection->begin();

        try {
            // Calculate the total amount
            $totalAmount = array_sum(array_map(function ($item) {
                return $item['quantity'] * $item['price'];
            }, $cart));

            // Set the order date to the current date
            $orderDate = date('Y-m-d');

            // Set the delivery date to a specific number of days from the order date
            $deliveryDate = (new DateTime($orderDate))->modify('+5 days')->format('Y-m-d');

            $orderDelivery = $this->OrderDeliveries->newEntity([
                'orderstatus_id' => 'ORS-00001',
                'deliverystatus_id' => 'DEL-00001',
                'order_date' => $orderDate,
                'total_amount' => $totalAmount,
                'delivery_date' => $deliveryDate,
            ]);

            if ($this->OrderDeliveries->save($orderDelivery)) {
                // Now, use $orderDelivery->id as the foreign key for each order_flower entry
                // Process the cart and create order_flower entries, and save them
            } else {
                // Handle the error in case the order_delivery wasn't saved
                throw new Exception('Unable to save order delivery.');
            }

            // If everything goes well, commit the transaction
            $connection->commit();
            $session->delete('Cart');
            $this->Flash->success(__('You\'ve successfully checked out your cart!'));
            // Redirect to a confirmation page or back to the cart
            return $this->redirect(['controller' => 'Flowers', 'action' => 'customerShoppingCart']);


        } catch (Exception $e) {
            // If there is an error, rollback the transaction
            $connection->rollback();
            $this->Flash->error(__('Error processing your order: ' . $e->getMessage()));
        }
        return $this->redirect(['controller' => 'Pages', 'action' => 'display', 'home']);
    }

}
