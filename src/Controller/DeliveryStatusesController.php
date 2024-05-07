<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * DeliveryStatuses Controller
 *
 * @property \App\Model\Table\DeliveryStatusesTable $DeliveryStatuses
 */
class DeliveryStatusesController extends AppController
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
        $query = $this->DeliveryStatuses->find();
        $deliveryStatuses = $this->paginate($query);

        $this->set(compact('deliveryStatuses'));
    }

    /**
     * View method
     *
     * @param string|null $id Delivery Status id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $deliveryStatus = $this->DeliveryStatuses->get($id, contain: []);
        $this->set(compact('deliveryStatus'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $deliveryStatus = $this->DeliveryStatuses->newEmptyEntity();
        if ($this->request->is('post')) {
            $deliveryStatus = $this->DeliveryStatuses->patchEntity($deliveryStatus, $this->request->getData());
            if ($this->DeliveryStatuses->save($deliveryStatus)) {
                $this->Flash->success(__('The delivery status has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The delivery status could not be saved. Please, try again.'));
        }
        $this->set(compact('deliveryStatus'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Delivery Status id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $deliveryStatus = $this->DeliveryStatuses->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $deliveryStatus = $this->DeliveryStatuses->patchEntity($deliveryStatus, $this->request->getData());
            if ($this->DeliveryStatuses->save($deliveryStatus)) {
                $this->Flash->success(__('The delivery status has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The delivery status could not be saved. Please, try again.'));
        }
        $this->set(compact('deliveryStatus'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Delivery Status id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $deliveryStatus = $this->DeliveryStatuses->get($id);
        if ($this->DeliveryStatuses->delete($deliveryStatus)) {
            $this->Flash->success(__('The delivery status has been deleted.'));
        } else {
            $this->Flash->error(__('The delivery status could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
