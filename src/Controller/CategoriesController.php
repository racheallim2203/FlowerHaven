<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Categories Controller
 *
 * @property \App\Model\Table\CategoriesTable $Categories
 *  * @property \App\Model\Table\FlowersTable $Flowers
 */
class CategoriesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Categories->find('all', [
            'contain' => ['Flowers'],
            'order' => ['Categories.category_name' => 'asc']
        ]);

        $search = $this->request->getQuery('search');
        $category = $this->request->getQuery('category');

        if (!empty($search)) {
            $query->matching('Flowers', function ($q) use ($search) {
                return $q->where(['Flowers.flower_name LIKE' => '%' . $search . '%']);
            });
        }
        if (!empty($category)) {
            $query->where(['Categories.id' => $category]);
        }

        $categoriesList = $this->Categories->find('list', [
            'keyField' => 'id',
            'valueField' => 'category_name'
        ])->toArray();

        $categories = $this->paginate($query);
        $this->set(compact('categories', 'categoriesList'));
    }


    /**
     * View method
     *
     * @param string|null $id Categories id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $category = $this->Categories->get($id, contain: ['Flowers']);
        $this->set(compact('category'));
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
            if ($this->Flowers->save($flower)) {
                $this->Flash->success(__('The flower has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The flower could not be saved. Please, try again.'));
        }

        // Fetch categories for the drop-down
        $categories = $this->Flowers->Categories->find('list', [
            'keyField' => 'id',
            'valueField' => 'category_name'
        ]);

        $this->set(compact('flower', 'categories'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Categories id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $category = $this->Categories->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $category = $this->Categories->patchEntity($category, $this->request->getData());
            if ($this->Categories->save($category)) {
                $this->Flash->success(__('The category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The category could not be saved. Please, try again.'));
        }
        $this->set(compact('category'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Categories id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $category = $this->Categories->get($id);
        if ($this->Categories->delete($category)) {
            $this->Flash->success(__('The category has been deleted.'));
        } else {
            $this->Flash->error(__('The category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
