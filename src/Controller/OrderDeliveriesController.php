<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Datasource\ConnectionManager;
use DateTime;
use Exception;
use Cake\ORM\TableRegistry;

/**
 * OrderDeliveries Controller
 *
 * @property \App\Model\Table\OrderDeliveriesTable $OrderDeliveries
 * @property \App\Model\Table\FlowersTable $Flowers
 *
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
            if (empty($cart)) {
                return $this->responseJson(['success' => false, 'message' => 'Your cart is empty.']);
//            } else {
//                return $this->redirect(['controller' => 'Pages', 'action' => 'display', 'home']);
            }
        }

        $flowersTable = TableRegistry::getTableLocator()->get('Flowers');
        $connection = ConnectionManager::get('default');
        $connection->begin();

        try {
            $totalAmount = array_sum(array_map(function ($item) {
                return $item['quantity'] * $item['price'];
            }, $cart));

            $orderDate = date('Y-m-d');
            $deliveryDate = (new DateTime($orderDate))->modify('+5 days')->format('Y-m-d');

            $orderDelivery = $this->OrderDeliveries->newEntity([
                'orderstatus_id' => 'ORS-00001',
                'deliverystatus_id' => 'DEL-00001',
                'order_date' => $orderDate,
                'total_amount' => $totalAmount,
                'delivery_date' => $deliveryDate,
            ]);

            if (!$this->OrderDeliveries->save($orderDelivery)) {
                throw new Exception('Unable to save order delivery.');
            }

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

            $connection->commit();
            $session->delete('Cart');
            // Return JSON response with orderDeliveryId
            return $this->responseJson([
                'success' => true,
                'message' => 'Payment processed successfully',
                'orderDeliveryId' => $orderDelivery->id
            ]);

        } catch (Exception $e) {
            $connection->rollback();
            return $this->responseJson(['success' => false, 'message' => 'Error processing your order: ' . $e->getMessage()]);
        }
    }
    private function responseJson($data) {
        $this->autoRender = false;
        if ($this->request->is('ajax')) {
            return $this->response->withType('application/json')
                ->withStringBody(json_encode($data));
        } else {
            return $this->redirect(['controller' => 'Pages', 'action' => 'display', 'home']);
        }
    }

}
