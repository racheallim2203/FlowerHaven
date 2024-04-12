<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * OrderDelivery Controller
 *
 * @property \App\Model\Table\OrderDeliveryTable $OrderDelivery
 */
class OrderDeliveryController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->OrderDelivery->find()
            ->contain(['OrderStatus', 'DeliveryStatus']);
        $orderDelivery = $this->paginate($query);

        $this->set(compact('orderDelivery'));
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
        $orderDelivery = $this->OrderDelivery->get($id, contain: ['OrderStatus', 'DeliveryStatus']);
        $this->set(compact('orderDelivery'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $orderDelivery = $this->OrderDelivery->newEmptyEntity();
        if ($this->request->is('post')) {
            $orderDelivery = $this->OrderDelivery->patchEntity($orderDelivery, $this->request->getData());
            if ($this->OrderDelivery->save($orderDelivery)) {
                $this->Flash->success(__('The order delivery has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order delivery could not be saved. Please, try again.'));
        }
        $orderStatus = $this->OrderDelivery->OrderStatus->find('list', limit: 200)->all();
        $deliveryStatus = $this->OrderDelivery->DeliveryStatus->find('list', limit: 200)->all();
        $this->set(compact('orderDelivery', 'orderStatus', 'deliveryStatus'));
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
        $orderDelivery = $this->OrderDelivery->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $orderDelivery = $this->OrderDelivery->patchEntity($orderDelivery, $this->request->getData());
            if ($this->OrderDelivery->save($orderDelivery)) {
                $this->Flash->success(__('The order delivery has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order delivery could not be saved. Please, try again.'));
        }
        $orderStatus = $this->OrderDelivery->OrderStatus->find('list', limit: 200)->all();
        $deliveryStatus = $this->OrderDelivery->DeliveryStatus->find('list', limit: 200)->all();
        $this->set(compact('orderDelivery', 'orderStatus', 'deliveryStatus'));
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
        $orderDelivery = $this->OrderDelivery->get($id);
        if ($this->OrderDelivery->delete($orderDelivery)) {
            $this->Flash->success(__('The order delivery has been deleted.'));
        } else {
            $this->Flash->error(__('The order delivery could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
