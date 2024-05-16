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
        // Send a query to the database to fetch all the Flowers and order them in ascending order of category name
        $query = $this->Categories->find('all',
            contain: ['Flowers'],
            order: ['Categories.category_name' => 'asc']);

        // Create a query reference for the search variable
        $search = $this->request->getQuery('search');
        // Create a query reference for the category variable
        $category = $this->request->getQuery('category');

        // Implementing the search bar functionality for flowers
        if (!empty($search)) {
            $query->matching('Flowers', function ($q) use ($search) {
                return $q->where(['Flowers.flower_name LIKE' => '%' . $search . '%']);
            });
        }

        // Implementing the filter functionality for categories of flowers
        if (!empty($category)) {
            $query->where(['Categories.id' => $category]);
        }

        // Combine the categories into an array list of categories 
        $categoriesList = $this->Categories->find('list', keyField: 'id', valueField: 'category_name')->toArray();
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
        // Reference and get the specified id of the flower that wants to be viewed
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
        $category = $this->Categories->newEmptyEntity();
        if ($this->request->is('post')) {
            $category = $this->Categories->patchEntity($category, $this->request->getData());
            // If the category has been saved successfully, display the message below
            if ($this->Category->save($category)) {
                $this->Flash->success(__('The category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            // If the category has not been saved successfully, display the message below
            $this->Flash->error(__('The category could not be saved. Please, try again.'));
        }
        $this->set(compact('category'));
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
            // If the category has been saved successfully, display the message below
            if ($this->Categories->save($category)) {
                $this->Flash->success(__('The category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            // If the category has not been saved successfully, display the message below
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
        // If the category has been deleted successfully, display the message below
        if ($this->Categories->delete($category)) {
            $this->Flash->success(__('The category has been deleted.'));
        } else {
            // If the category has been deleted successfully, display the message below
            $this->Flash->error(__('The category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
