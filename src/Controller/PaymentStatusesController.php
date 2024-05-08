<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * PaymentStatuses Controller
 *
 * @property \App\Model\Table\PaymentStatusesTable $PaymentStatuses
 */
class PaymentStatusesController extends AppController
{
    /**
     * Controller initialize override 
     * Verifies whether the user accessing the page is an admin or not
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        // Get the current user's ID and details
        $result = $this->Authentication->getResult();
        $userIsAdmin = $result->getData()->isAdmin;
    
        // Check if the current user is an admin
        if ($userIsAdmin == 0) {
            // Render the custom error401 page if the user is not an admin
            $this->response = $this->response->withStatus(401);
            $this->viewBuilder()->setTemplatePath('Error');
            $this->viewBuilder()->setTemplate('error401');
            $this->render();
        }
    }
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->PaymentStatuses->find();
        $paymentStatuses = $this->paginate($query);

        $this->set(compact('paymentStatuses'));
    }

    /**
     * View method
     *
     * @param string|null $id Payment Status id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $paymentStatus = $this->PaymentStatuses->get($id, contain: []);
        $this->set(compact('paymentStatus'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $paymentStatus = $this->PaymentStatuses->newEmptyEntity();
        if ($this->request->is('post')) {
            $paymentStatus = $this->PaymentStatuses->patchEntity($paymentStatus, $this->request->getData());
            if ($this->PaymentStatuses->save($paymentStatus)) {
                $this->Flash->success(__('The payment status has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The payment status could not be saved. Please, try again.'));
        }
        $this->set(compact('paymentStatus'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Payment Status id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $paymentStatus = $this->PaymentStatuses->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $paymentStatus = $this->PaymentStatuses->patchEntity($paymentStatus, $this->request->getData());
            if ($this->PaymentStatuses->save($paymentStatus)) {
                $this->Flash->success(__('The payment status has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The payment status could not be saved. Please, try again.'));
        }
        $this->set(compact('paymentStatus'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Payment Status id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $paymentStatus = $this->PaymentStatuses->get($id);
        if ($this->PaymentStatuses->delete($paymentStatus)) {
            $this->Flash->success(__('The payment status has been deleted.'));
        } else {
            $this->Flash->error(__('The payment status could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
