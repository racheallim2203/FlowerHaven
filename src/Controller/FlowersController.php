<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Flowers Controller
 *
 * @property \App\Model\Table\FlowersTable $Flowers
 */
class FlowersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Flowers->find('all', [
            'contain' => ['Categories'],
            'order' => ['Flowers.stock_quantity' => 'asc']
        ]);

        $search = $this->request->getQuery('search');
        $categories = $this->request->getQuery('category');

        if (!empty($search)) {
            $query->where(['Flowers.flower_name LIKE' => '%' . $search . '%']);
        }

        if (!empty($category)) {
            $query->where(['Categories.id' => $categories]);
        }

        $flowers = $this->paginate($query);
        $categories = $this->Flowers->Categories->find('list');
        $this->set(compact('flowers', 'categories'));
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
        $flower = $this->Flowers->get($id, contain: ['Categories', 'OrderFlowers']);
        $this->set(compact('flower'));
    }

    public function customerIndex()
    {
        $query = $this->Flowers->find('all', [
            'contain' => ['Categories']
        ]);
        $flowers = $this->paginate($query);
        $this->viewBuilder()->setLayout('default2');
        $this->set(compact('flowers'));
    }

    public function customerView($id = null)
    {
        $flower = $this->Flowers->get($id, contain: ['Categories', 'OrderFlowers']);
        $this->viewBuilder()->setLayout('default2');
        $this->set(compact('flower'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $flower = $this->Flowers->newEmptyEntity();
        if ($this->request->is('post')) {
            $flower = $this->Flowers->patchEntity($flower, $this->request->getData());

            if(!$flower->getErrors) {

                $image = $this->request->getData('image');
                $name = $image->getClientFilename();

                $targetPath = WWW_ROOT . 'img' . DS . $name;

                if ($name)
                    $image->moveTo($targetPath);

                $flower->image = $name;

            }
            if ($this->Flowers->save($flower)) {
                $this->Flash->success(__('The flower has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The flower could not be saved. Please, try again.'));
        }
        $categories = $this->Flowers->Categories->find('list', limit: 200)->all();
        $this->set(compact('flower', 'categories'));
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
        $flower = $this->Flowers->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $flower = $this->Flowers->patchEntity($flower, $this->request->getData());
            if ($this->Flowers->save($flower)) {
                $this->Flash->success(__('The flower has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The flower could not be saved. Please, try again.'));
        }
        $categories = $this->Flowers->Categories->find('list', limit: 200)->all();
        $this->set(compact('flower', 'categories'));
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
        $flower = $this->Flowers->get($id);
        if ($this->Flowers->delete($flower)) {
            $this->Flash->success(__('The flower has been deleted.'));
        } else {
            $this->Flash->error(__('The flower could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
