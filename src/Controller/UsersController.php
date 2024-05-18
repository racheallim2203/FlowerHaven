<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\I18n\FrozenTime;
use Cake\Datasource\ConnectionManager;
use Cake\Utility\Security;
use Cake\I18n\DateTime;
use Cake\Mailer\Mailer;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
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
        $query = $this->Users->find('all', [
            'order' => [
                'Users.isArchived' => 'ASC', // Unarchived users first
            ]
        ]);

        // Filter and search functionality
        $search = $this->request->getQuery('search');
        $archive = $this->request->getQuery('archive');

        if (!empty($search)) {
            $query->where(['Users.username LIKE' => '%' . $search . '%']);
        }

        if ($archive !== '' && $archive !== null) {
            $query->where(['Users.isArchived' => (int)$archive]);
        }

        $users = $this->paginate($query);

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, contain: ['Payments']);
        $this->set(compact('user'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            
            $user = $this->Users->patchEntity($user, $this->request->getData());

            // Generate a nonce and set an expiry date (7 days from now)
            $user->nonce = Security::randomString(32);  // Length can be adjusted as necessary
            $user->nonce_expiry = new \DateTime('+7 days');  // This sets the expiry to 7 days from registration date
            $user->isArchived = 0; // Sets the default isArchived value to be not archived (0)

            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, contain: []);
    
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
    
            // Update the nonce_expiry to be 12 hours from now
            $data['nonce_expiry'] = (new FrozenTime())->addHours(12);
    
            $user = $this->Users->patchEntity($user, $data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been updated successfully.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
    }
    

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);

        // Prevent deleting if the user is an admin or if the user is the currently logged-in user
        if ($user->isAdmin || $user->id == $this->request->getSession()->read('Auth.User.id')) {
            $this->Flash->error(__('You cannot delete this user because they are an admin.'));
            return $this->redirect(['action' => 'index']);
        }

        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Archive method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     */
    public function archive($id = null)
    {
        $user = $this->Users->get($id, contain: []);
    
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
    
            // Update the nonce_expiry to be 12 hours from now
            $data['nonce_expiry'] = (new FrozenTime())->addHours(12);
            // Sets the isArchived value to 1, so it is now archived
            $user->isArchived = 1; 
    
            $user = $this->Users->patchEntity($user, $data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been archived successfully.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be archived. Please, try again.'));
            }
        }
        $this->set(compact('user'));
    }

    /**
     * Unarchive method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     */
    public function unarchive($id = null)
    {
        $user = $this->Users->get($id, contain: []);
    
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
    
            // Update the nonce_expiry to be 12 hours from now
            $data['nonce_expiry'] = (new FrozenTime())->addHours(12);
            // Sets the isArchived value to 1, so it is now archived
            $user->isArchived = 0; 
    
            $user = $this->Users->patchEntity($user, $data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been unarchived successfully.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be unarchived. Please, try again.'));
            }
        }
        $this->set(compact('user'));
    }
}
