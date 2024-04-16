<?php
declare(strict_types=1);

namespace OLDFILES\OLDCONTROLLERS;

use App\Controller\AppController;

/**
 * OrderFlower Controller
 *
 * @property \App\Model\Table\OldTables\OrderFlowerTable $OrderFlower
 */
class OrderFlowerController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->OrderFlower->find()
            ->contain(['Flowers', 'OrderDelivery']);
        $orderFlower = $this->paginate($query);

        $this->set(compact('orderFlower'));
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
        $orderFlower = $this->OrderFlower->get($id, contain: ['Flowers', 'OrderDelivery']);
        $this->set(compact('orderFlower'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $orderFlower = $this->OrderFlower->newEmptyEntity();
        if ($this->request->is('post')) {
            $orderFlower = $this->OrderFlower->patchEntity($orderFlower, $this->request->getData());
            if ($this->OrderFlower->save($orderFlower)) {
                $this->Flash->success(__('The order flower has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order flower could not be saved. Please, try again.'));
        }
        $flower = $this->OrderFlower->Flower->find('list', limit: 200)->all();
        $orderDelivery = $this->OrderFlower->OrderDelivery->find('list', limit: 200)->all();
        $this->set(compact('orderFlower', 'flower', 'orderDelivery'));
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
        $orderFlower = $this->OrderFlower->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $orderFlower = $this->OrderFlower->patchEntity($orderFlower, $this->request->getData());
            if ($this->OrderFlower->save($orderFlower)) {
                $this->Flash->success(__('The order flower has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order flower could not be saved. Please, try again.'));
        }
        $flower = $this->OrderFlower->Flower->find('list', limit: 200)->all();
        $orderDelivery = $this->OrderFlower->OrderDelivery->find('list', limit: 200)->all();
        $this->set(compact('orderFlower', 'flower', 'orderDelivery'));
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
        $orderFlower = $this->OrderFlower->get($id);
        if ($this->OrderFlower->delete($orderFlower)) {
            $this->Flash->success(__('The order flower has been deleted.'));
        } else {
            $this->Flash->error(__('The order flower could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
