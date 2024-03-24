<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * CategoriesProducts Controller
 *
 * @property \App\Model\Table\CategoriesProductsTable $CategoriesProducts
 */
class CategoriesProductsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->CategoriesProducts->find()
            ->contain(['Categories', 'Products']);
        $categoriesProducts = $this->paginate($query);

        $this->set(compact('categoriesProducts'));
    }

    /**
     * View method
     *
     * @param string|null $id Categories Product id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $categoriesProduct = $this->CategoriesProducts->get($id, contain: ['Categories', 'Products']);
        $this->set(compact('categoriesProduct'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $categoriesProduct = $this->CategoriesProducts->newEmptyEntity();
        if ($this->request->is('post')) {
            $categoriesProduct = $this->CategoriesProducts->patchEntity($categoriesProduct, $this->request->getData());
            if ($this->CategoriesProducts->save($categoriesProduct)) {
                $this->Flash->success(__('The categories product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The categories product could not be saved. Please, try again.'));
        }
        $categories = $this->CategoriesProducts->Categories->find('list', limit: 200)->all();
        $products = $this->CategoriesProducts->Products->find('list', limit: 200)->all();
        $this->set(compact('categoriesProduct', 'categories', 'products'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Categories Product id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $categoriesProduct = $this->CategoriesProducts->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $categoriesProduct = $this->CategoriesProducts->patchEntity($categoriesProduct, $this->request->getData());
            if ($this->CategoriesProducts->save($categoriesProduct)) {
                $this->Flash->success(__('The categories product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The categories product could not be saved. Please, try again.'));
        }
        $categories = $this->CategoriesProducts->Categories->find('list', limit: 200)->all();
        $products = $this->CategoriesProducts->Products->find('list', limit: 200)->all();
        $this->set(compact('categoriesProduct', 'categories', 'products'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Categories Product id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $categoriesProduct = $this->CategoriesProducts->get($id);
        if ($this->CategoriesProducts->delete($categoriesProduct)) {
            $this->Flash->success(__('The categories product has been deleted.'));
        } else {
            $this->Flash->error(__('The categories product could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
