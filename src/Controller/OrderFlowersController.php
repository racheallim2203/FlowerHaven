<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\ORM\TableRegistry; // Import the TableRegistry
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Http\Exception\NotFoundException;
use App\Controller\AppController;
use Exception;


/**
 * OrderFlowers Controller
 *
 * @property \App\Model\Table\OrderFlowersTable $OrderFlowers
 * @property \App\Model\Table\FlowersTable $Flowers
 * @property \App\Model\Table\OrderDeliveriesTable $OrderDelivery
 * @property \App\Model\Table\OrderFlowersTable $OrderFlower
 */
class OrderFlowersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->OrderFlowers->find()
            ->contain(['Flowers', 'OrderDeliveries']);
        $orderFlowers = $this->paginate($query);

        $this->set(compact('orderFlowers'));
    }


    /**
     * View method
     *
     * @param string|null $id Order Flowers id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $orderFlower = $this->OrderFlowers->get($id, contain: ['Flowers', 'OrderDeliveries']);
        $this->set(compact('orderFlower'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $orderFlower = $this->OrderFlowers->newEmptyEntity();
        if ($this->request->is('post')) {
            $orderFlower = $this->OrderFlowers->patchEntity($orderFlower, $this->request->getData());
            if ($this->OrderFlowers->save($orderFlower)) {
                $this->Flash->success(__('The order flower has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order flower could not be saved. Please, try again.'));
        }
        $flowers = $this->OrderFlowers->Flowers->find('list', limit: 200)->all();
        $orderDeliveries = $this->OrderFlowers->OrderDeliveries->find('list', limit: 200)->all();
        $this->set(compact('orderFlower', 'flowers', 'orderDeliveries'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Order Flowers id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $orderFlower = $this->OrderFlowers->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $orderFlower = $this->OrderFlowers->patchEntity($orderFlower, $this->request->getData());
            if ($this->OrderFlowers->save($orderFlower)) {
                $this->Flash->success(__('The order flower has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order flower could not be saved. Please, try again.'));
        }
        $flowers = $this->OrderFlowers->Flowers->find('list', limit: 200)->all();
        $orderDeliveries = $this->OrderFlowers->OrderDeliveries->find('list', limit: 200)->all();
        $this->set(compact('orderFlower', 'flowers', 'orderDeliveries'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Order Flowers id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $orderFlower = $this->OrderFlowers->get($id);
        if ($this->OrderFlowers->delete($orderFlower)) {
            $this->Flash->success(__('The order flower has been deleted.'));
        } else {
            $this->Flash->error(__('The order flower could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    public function processOrder()
    {
        $session = $this->request->getSession();
        $cart = $session->read('Cart');
        if (empty($cart)) {
            $this->Flash->error(__('Your cart is empty.'));
            return $this->redirect(['controller' => 'Pages', 'action' => 'aboutus']);
        }

        $flowersTable = TableRegistry::getTableLocator()->get('Flowers');
        $orderFlowersTable = TableRegistry::getTableLocator()->get('OrderFlowers');
        $orderDeliveriesTable = TableRegistry::getTableLocator()->get('OrderDeliveries');
        $connection = $orderFlowersTable->getConnection();
        $connection->begin();

        try {
            // Initialize order ID counter
            $orderIdCounter = 1;

            // Predefined order delivery IDs (modify as needed)
            $predefinedDeliveryIds = ['OOD-00001', 'OOD-00002', 'OOD-00003'];

            foreach ($cart as $flowerId => $item) {
                $flower = $flowersTable->get($flowerId);
                if ($flower->stock_quantity < $item['quantity']) {
                    $connection->rollback();
                    $this->Flash->error(__('Not enough stock for ' . $flower->flower_name));
                    return $this->redirect($this->referer());
                }

                $flower->stock_quantity -= $item['quantity'];
                if (!$flowersTable->save($flower)) {
                    $connection->rollback();
                    throw new Exception('Failed to update stock for ' . $flower->flower_name);
                }

                // Randomly select a predefined order delivery ID
                $orderDeliveryId = $predefinedDeliveryIds[array_rand($predefinedDeliveryIds)];

                $orderFlower = $orderFlowersTable->newEntity([
                    'order_id' => 'ORD-' . str_pad(settype($orderIdCounter, 'string'), 5, '0', STR_PAD_LEFT),  // Type casting for str_pad
                    'flower_id' => $flowerId,
                    'order_delivery_id' => $orderDeliveryId,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'total_price' => $item['quantity'] * $item['price']
                ]);

                if (!$orderFlowersTable->save($orderFlower)) {
                    $connection->rollback();
                    throw new Exception('Failed to save order detail for ' . $flower->flower_name);
                }

                $orderIdCounter++; // Increment counter after use
            }

            $connection->commit();
            $session->delete('Cart');
            $this->Flash->success(__('Your order has been placed successfully.'));
            return $this->redirect(['controller' => 'Pages', 'action' => 'aboutus']);

        } catch (Exception $e) {
            $this->Flash->error(__('Error processing your order: ' . $e->getMessage()));
            return $this->redirect(['controller' => 'Flowers', 'action' => 'customerShoppingCart']);
        }
    }
}
