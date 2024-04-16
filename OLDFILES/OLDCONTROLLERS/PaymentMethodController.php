<?php
declare(strict_types=1);

namespace OLDFILES\OLDCONTROLLERS;

use App\Controller\AppController;

/**
 * PaymentMethod Controller
 *
 * @property \App\Model\Table\OldTables\PaymentMethodTable $PaymentMethod
 */
class PaymentMethodController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->PaymentMethod->find();
        $paymentMethod = $this->paginate($query);

        $this->set(compact('paymentMethod'));
    }

    /**
     * View method
     *
     * @param string|null $id Payment Method id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $paymentMethod = $this->PaymentMethod->get($id, contain: []);
        $this->set(compact('paymentMethod'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $paymentMethod = $this->PaymentMethod->newEmptyEntity();
        if ($this->request->is('post')) {
            $paymentMethod = $this->PaymentMethod->patchEntity($paymentMethod, $this->request->getData());
            if ($this->PaymentMethod->save($paymentMethod)) {
                $this->Flash->success(__('The payment method has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The payment method could not be saved. Please, try again.'));
        }
        $this->set(compact('paymentMethod'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Payment Method id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $paymentMethod = $this->PaymentMethod->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $paymentMethod = $this->PaymentMethod->patchEntity($paymentMethod, $this->request->getData());
            if ($this->PaymentMethod->save($paymentMethod)) {
                $this->Flash->success(__('The payment method has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The payment method could not be saved. Please, try again.'));
        }
        $this->set(compact('paymentMethod'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Payment Method id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $paymentMethod = $this->PaymentMethod->get($id);
        if ($this->PaymentMethod->delete($paymentMethod)) {
            $this->Flash->success(__('The payment method has been deleted.'));
        } else {
            $this->Flash->error(__('The payment method could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
