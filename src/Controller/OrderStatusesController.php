<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * OrderStatuses Controller
 *
 * @property \App\Model\Table\OrderStatusesTable $OrderStatuses
 */
class OrderStatusesController extends AppController
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
        $query = $this->OrderStatuses->find();
        $orderStatuses = $this->paginate($query);

        $this->set(compact('orderStatuses'));
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
        $orderStatus = $this->OrderStatuses->get($id, contain: []);
        $this->set(compact('orderStatus'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $orderStatus = $this->OrderStatuses->newEmptyEntity();
        if ($this->request->is('post')) {
            $orderStatus = $this->OrderStatuses->patchEntity($orderStatus, $this->request->getData());
            if ($this->OrderStatuses->save($orderStatus)) {
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
        $orderStatus = $this->OrderStatuses->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $orderStatus = $this->OrderStatuses->patchEntity($orderStatus, $this->request->getData());
            if ($this->OrderStatuses->save($orderStatus)) {
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
        $orderStatus = $this->OrderStatuses->get($id);
        if ($this->OrderStatuses->delete($orderStatus)) {
            $this->Flash->success(__('The order status has been deleted.'));
        } else {
            $this->Flash->error(__('The order status could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
