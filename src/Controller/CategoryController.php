<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Category Controller
 *
 * @property \App\Model\Table\CategoryTable $Category
 */
class CategoryController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index() {
        $query = $this->Category->find('all', [
            'contain' => ['Flower'],
            'order' => ['Category.category_name' => 'asc'] // Or any other default sorting you prefer
        ]);

        $search = $this->request->getQuery('search');
        $category = $this->request->getQuery('category');

        if (!empty($search)) {
            // Use matching to apply conditions on associated data
            $query->matching('Flower', function ($q) use ($search) {
                return $q->where(['Flower.flower_name LIKE' => '%' . $search . '%']);
            });
        }
        if (!empty($category)) {
            $query->where(['Category.id' => $category]);
        }
        $categoriesList = $this->Category->find('list', [
            'keyField' => 'id',
            'valueField' => 'category_name'
        ])->toArray();

        $categories = $this->paginate($query);
        $this->set(compact('categories', 'categoriesList'));
    }

    /**
     * View method
     *
     * @param string|null $id Category id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {

        $category = $this->Category->get($id, [
            'contain' => ['Flower'],
        ]);
        $this->set(compact('category'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $category = $this->Category->newEmptyEntity();
        if ($this->request->is('post')) {
            $category = $this->Category->patchEntity($category, $this->request->getData());
            if ($this->Category->save($category)) {
                $this->Flash->success(__('The category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The category could not be saved. Please, try again.'));
        }
        $this->set(compact('category'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Category id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $category = $this->Category->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $category = $this->Category->patchEntity($category, $this->request->getData());
            if ($this->Category->save($category)) {
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
     * @param string|null $id Category id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $category = $this->Category->get($id);
        if ($this->Category->delete($category)) {
            $this->Flash->success(__('The category has been deleted.'));
        } else {
            $this->Flash->error(__('The category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
