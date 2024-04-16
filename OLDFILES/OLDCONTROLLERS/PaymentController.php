<?php
declare(strict_types=1);

namespace OLDFILES\OLDCONTROLLERS;

use App\Controller\AppController;

/**
 * Payment Controller
 *
 * @property \App\Model\Table\OldTables\PaymentTable $Payment
 */
class PaymentController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Payment->find()
            ->contain(['OrderDelivery', 'PaymentStatus', 'PaymentMethod', 'User']);
        $payment = $this->paginate($query);

        $this->set(compact('payment'));
    }

    /**
     * View method
     *
     * @param string|null $id Payment id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $payment = $this->Payment->get($id, contain: ['OrderDelivery', 'PaymentStatus', 'PaymentMethod', 'User']);
        $this->set(compact('payment'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $payment = $this->Payment->newEmptyEntity();
        if ($this->request->is('post')) {
            $payment = $this->Payment->patchEntity($payment, $this->request->getData());
            if ($this->Payment->save($payment)) {
                $this->Flash->success(__('The payment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The payment could not be saved. Please, try again.'));
        }
        $orderDelivery = $this->Payment->OrderDelivery->find('list', limit: 200)->all();
        $paymentStatus = $this->Payment->PaymentStatus->find('list', limit: 200)->all();
        $paymentMethod = $this->Payment->PaymentMethod->find('list', limit: 200)->all();
        $user = $this->Payment->User->find('list', limit: 200)->all();
        $this->set(compact('payment', 'orderDelivery', 'paymentStatus', 'paymentMethod', 'user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Payment id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $payment = $this->Payment->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $payment = $this->Payment->patchEntity($payment, $this->request->getData());
            if ($this->Payment->save($payment)) {
                $this->Flash->success(__('The payment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The payment could not be saved. Please, try again.'));
        }
        $orderDelivery = $this->Payment->OrderDelivery->find('list', limit: 200)->all();
        $paymentStatus = $this->Payment->PaymentStatus->find('list', limit: 200)->all();
        $paymentMethod = $this->Payment->PaymentMethod->find('list', limit: 200)->all();
        $user = $this->Payment->User->find('list', limit: 200)->all();
        $this->set(compact('payment', 'orderDelivery', 'paymentStatus', 'paymentMethod', 'user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Payment id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $payment = $this->Payment->get($id);
        if ($this->Payment->delete($payment)) {
            $this->Flash->success(__('The payment has been deleted.'));
        } else {
            $this->Flash->error(__('The payment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
