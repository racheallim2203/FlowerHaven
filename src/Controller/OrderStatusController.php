<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * OrderStatus Controller
 *
 * @property \App\Model\Table\OrderStatusTable $OrderStatus
 */
class OrderStatusController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->OrderStatus->find();
        $orderStatus = $this->paginate($query);

        $this->set(compact('orderStatus'));
    }

    /**
     * View method
     *
     * @param string|null $id Order Status id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $orderStatus = $this->OrderStatus->get($id, contain: []);
        $this->set(compact('orderStatus'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $orderStatus = $this->OrderStatus->newEmptyEntity();
        if ($this->request->is('post')) {
            $orderStatus = $this->OrderStatus->patchEntity($orderStatus, $this->request->getData());
            if ($this->OrderStatus->save($orderStatus)) {
                $this->Flash->success(__('The order status has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order status could not be saved. Please, try again.'));
        }
        $this->set(compact('orderStatus'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Order Status id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $orderStatus = $this->OrderStatus->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $orderStatus = $this->OrderStatus->patchEntity($orderStatus, $this->request->getData());
            if ($this->OrderStatus->save($orderStatus)) {
                $this->Flash->success(__('The order status has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order status could not be saved. Please, try again.'));
        }
        $this->set(compact('orderStatus'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Order Status id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $orderStatus = $this->OrderStatus->get($id);
        if ($this->OrderStatus->delete($orderStatus)) {
            $this->Flash->success(__('The order status has been deleted.'));
        } else {
            $this->Flash->error(__('The order status could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
