<?php
declare(strict_types=1);

namespace OLDFILES\OLDCONTROLLERS;

use App\Controller\AppController;

/**
 * DeliveryStatus Controller
 *
 * @property \App\Model\Table\OldTables\DeliveryStatusTable $DeliveryStatus
 */
class DeliveryStatusController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->DeliveryStatus->find();
        $deliveryStatus = $this->paginate($query);

        $this->set(compact('deliveryStatus'));
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
        $deliveryStatus = $this->DeliveryStatus->get($id, contain: []);
        $this->set(compact('deliveryStatus'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $deliveryStatus = $this->DeliveryStatus->newEmptyEntity();
        if ($this->request->is('post')) {
            $deliveryStatus = $this->DeliveryStatus->patchEntity($deliveryStatus, $this->request->getData());
            if ($this->DeliveryStatus->save($deliveryStatus)) {
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
        $deliveryStatus = $this->DeliveryStatus->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $deliveryStatus = $this->DeliveryStatus->patchEntity($deliveryStatus, $this->request->getData());
            if ($this->DeliveryStatus->save($deliveryStatus)) {
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
        $deliveryStatus = $this->DeliveryStatus->get($id);
        if ($this->DeliveryStatus->delete($deliveryStatus)) {
            $this->Flash->success(__('The delivery status has been deleted.'));
        } else {
            $this->Flash->error(__('The delivery status could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
