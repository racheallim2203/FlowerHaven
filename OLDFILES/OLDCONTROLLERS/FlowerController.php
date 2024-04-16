<?php
declare(strict_types=1);

namespace OLDFILES\OLDCONTROLLERS;

use App\Controller\AppController;

/**
 * Flowers Controller
 *
 * @property \App\Model\Table\OldTables\FlowerTable $Flowers
 */
class FlowerController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Flower->find('all', [
            'contain' => ['Categories'],
            'order' => ['Flowers.stock_quantity' => 'asc']
        ]);

        $search = $this->request->getQuery('search');
        $category = $this->request->getQuery('category');

        if (!empty($search)) {
            $query->where(['Flowers.flower_name LIKE' => '%' . $search . '%']);
        }

        if (!empty($category)) {
            $query->where(['Categories.id' => $category]);
        }

        $flowers = $this->paginate($query);
        $category = $this->Flower->Category->find('list');
        $this->set(compact('flowers', 'category'));
    }

    /**
     * Gallery Page for customers
     *
     * @return void
     */
    public function customerView()
    {
        $query = $this->Flower->find('all', [
            'contain' => ['Categories']
        ]);
        $flowers = $this->paginate($query);
        $this->viewBuilder()->setLayout('default2');
        $this->set(compact('flowers'));
    }


    /**
     * View method
     *
     * @param string|null $id Flowers id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $flower = $this->Flower->get($id, contain: ['Categories', 'OrderFlower']);
        $this->set(compact('flower'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $flower = $this->Flower->newEmptyEntity();
        if ($this->request->is('post')) {
            $flower = $this->Flower->patchEntity($flower, $this->request->getData());
            if ($this->Flower->save($flower)) {
                $this->Flash->success(__('The flower has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The flower could not be saved. Please, try again.'));
        }
        $category = $this->Flower->Category->find('list', limit: 200)->all();
        $this->set(compact('flower', 'category'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Flowers id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $flower = $this->Flower->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $flower = $this->Flower->patchEntity($flower, $this->request->getData());
            if ($this->Flower->save($flower)) {
                $this->Flash->success(__('The flower has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The flower could not be saved. Please, try again.'));
        }
        $category = $this->Flower->Category->find('list', limit: 200)->all();
        $this->set(compact('flower', 'category'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Flowers id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $flower = $this->Flower->get($id);
        if ($this->Flower->delete($flower)) {
            $this->Flash->success(__('The flower has been deleted.'));
        } else {
            $this->Flash->error(__('The flower could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
