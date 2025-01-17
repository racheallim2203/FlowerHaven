<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;

/**
 * Flowers Controller
 *
 * @property \App\Model\Table\FlowersTable $Flowers
 */
class FlowersController extends AppController
{
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('FormProtection');`
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        // Allow unauthenticated access to 'view' and 'index' actions
        $this->Authentication->allowUnauthenticated(['customerView', 'customerIndex', 'addToCart', 'customerShoppingCart', 'updateCart', 'removeFromCart']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
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

        // Proceed with flowers index function

        /**
         * Send a query to the database to fetch all the Flowers 
         * and order them so the archived flowers are displayed
         * at the bottom of the list and the stock quantity is also
         * ordered in ascending order.
         */
        $query = $this->Flowers->find('all', [
            'contain' => ['Categories'],
            'order' => [
                'Flowers.isArchived' => 'ASC', // Unarchived flowers first
                'Flowers.stock_quantity' => 'ASC' // Then sort by stock quantity
            ]
        ]);

        // Create a query reference for the search variable
        $search = $this->request->getQuery('search');
        // Create a query reference for the category variable
        $category = $this->request->getQuery('category');
        // Create a query reference for the archive variable
        $archive = $this->request->getQuery('archive');

        // Implementing the search bar functionality for flowers
        if (!empty($search)) {
            $query->where(['Flowers.flower_name LIKE' => '%' . $search . '%']);
        }

        // Implementing the filter functionality for categories of flowers
        if (!empty($category)) {
            $query->where(['Categories.id' => $category]);
        }

        // Implementing the filter functionality for archive of flowers
        if ($archive !== '' && $archive !== null) {
            $query->where(['Flowers.isArchived' => $archive]);
        }

        $flowers = $this->paginate($query);

        // Fetch category names for the dropdown
        $categories = $this->Flowers->Categories->find('list', keyField: 'id', valueField: 'category_name');
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

        // Proceed with flowers view function
        $flower = $this->Flowers->get($id, contain: ['Categories', 'OrderFlowers']);
        $this->set(compact('flower'));
    }

    /**
     * CustomerIndex method
     *
     * @param string|null $id Flowers id.
     */
    public function customerIndex()
    {
        /**
         * Send a query to the database to fetch all the Flowers 
         * and exclude them from the view if they are archived.
         */
        $query = $this->Flowers->find('all', [
            'contain' => ['Categories'],
            'conditions' => ['Flowers.isArchived' => 0] // Exclude archived flowers
        ]);
        
        // Create a query reference for the search variable
        $search = $this->request->getQuery('search');
        // Create a query reference for the category variable
        $category = $this->request->getQuery('category');

        // Implementing the search bar functionality for flowers
        if (!empty($search)) {
            $query->where(['Flowers.flower_name LIKE' => '%' . $search . '%']);
        }

        // Implementing the filter functionality for categories of flowers
        if (!empty($category)) {
            $query->where(['Categories.id' => $category]);
        }

        $flowers = $this->paginate($query);

        // Debugging line to check the output of the query
        // Log the count of flowers to see if it's working correctly
        // $this->log('Number of flowers found: ' . count($flowers), 'debug');

        // Fetch category names for the dropdown
        $categories = $this->Flowers->Categories->find('list', keyField:'id', valueField: 'category_name');

        $this->set(compact('flowers', 'categories'));
        $this->viewBuilder()->setLayout('default2');
    }

    /**
     * CustomerView method
     *
     * @param string|null $id Flowers id.
     */
    public function customerView($id = null)
    {
        // Reference and get the specified id of the flower that wants to be viewed
        $flower = $this->Flowers->get($id, contain: ['Categories', 'OrderFlowers']);
        $this->viewBuilder()->setLayout('default2');
        $this->set(compact('flower'));
    }

    /**
     * UpdateCart method
     *
     */
    public function updateCart()
    {
        $session = $this->request->getSession();
        $cart = $session->read('Cart');
        $updatedCart = $this->request->getData('cart');
        $flowersTable = TableRegistry::getTableLocator()->get('Flowers');
        $errors = false;  // Track if any errors occurred

        // Foreach item in the cart
        foreach ($updatedCart as $index => $item) {
            // Get the quantity (stock level) of flowers for the specified flower
            $requestedQuantity = (int) $item['quantity'];
            // If the quantity (stock level) is zero or less
            if ($requestedQuantity <= 0) {
                // Remove item if quantity is zero or less
                unset($cart[$index]);
                continue;
            }

            try {
                $flower = $flowersTable->get($index);
                // If the number of stock quantity added to cart is more than the stock quantity available
                if ($requestedQuantity > $flower->stock_quantity) {
                    $this->Flash->error(__('Requested quantity for ' . $flower->flower_name . ' exceeds available stock.'));
                    $errors = true;
                    continue; // Skip this item but continue processing others
                }

                // Update the cart item with the correct quantity and refresh stock info
                if (isset($cart[$index])) {
                    $cart[$index]['quantity'] = $requestedQuantity;
                    $cart[$index]['stock'] = $flower->stock_quantity; // Update stock in cart to reflect current stock
                }
            } catch (\Cake\Datasource\Exception\RecordNotFoundException $e) {
                // Handle case where flower no longer exists in the database
                $this->Flash->error(__('The flower with ID ' . $index . ' could not be found.'));
                unset($cart[$index]);  // Remove the missing item from the cart
                $errors = true;
            }
        }

        // Write the possibly updated cart back to the session
        if (!empty($cart)) {
            $session->write('Cart', $cart);
            if (!$errors) {
                // If the cart has been updated successfully, display below message
                $this->Flash->success(__('Cart updated successfully.'));
            }
        } else {
            $session->delete('Cart');
            $this->Flash->error(__('Your cart is empty.'));
        }

        return $this->redirect(['action' => 'customerShoppingCart']);
    }

    /**
     * UpdateStock method
     *
     */
    public function updateStock()
    {
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cart = $this->request->getData('cart');
            $flowersTable = TableRegistry::getTableLocator()->get('Flowers');

            // For each item in the cart
            foreach ($cart as $index => $item) {
                $flower = $flowersTable->get($index);
                if ($flower) {
                    $flower->stock_quantity = max(0, $item['quantity']); // Ensure non-negative stock
                    if (!$flowersTable->save($flower)) {
                        $this->Flash->error(__('Could not update quantity for ' . $flower->flower_name));
                        return $this->redirect(['action' => 'customerShoppingCart']);
                    }
                }
            }

            // If the cart has been updated successfully, display the message below and redirect back
            $this->Flash->success(__('Cart updated successfully.'));
            return $this->redirect(['action' => 'customerShoppingCart']);
        }
        // Display error message 
        $this->Flash->error(__('Invalid request.'));
        return $this->redirect(['action' => 'customerShoppingCart']);
    }

    /**
     * AddToCart method
     *
     */
    public function addToCart()
    {
        $data = $this->request->getData();
        $flowerId = $data['flower_id'];
        $quantity = (int)$data['quantity'];
        $flower = $this->Flowers->get($flowerId);

        // Checks to ensure there is enough stock quantity for the amount requested for
        if ($flower->stock_quantity >= $quantity && $quantity > 0) {
            $cart = $this->request->getSession()->read('Cart') ?: [];
            if (isset($cart[$flowerId])) {
                $cart[$flowerId]['quantity'] += $quantity;
            } else {
                $cart[$flowerId] = [
                    'flower_id' => $flowerId,
                    'quantity' => $quantity,
                    'price' => $flower->flower_price,
                    'name' => $flower->flower_name,
                    'stock' => $flower->stock_quantity  // Adding stock information
                ];
            }

            $this->request->getSession()->write('Cart', $cart);
            // If the flower has been added to the cart successfully, display the message below and redirect back
            $this->Flash->success(__('Successfully added to cart.'));
            return $this->redirect(['controller' => 'Flowers', 'action' => 'customerShoppingCart']);
        } else {
            // If there is not enough stock, display the message below and redirect back
            $this->Flash->error(__('Not enough stock available or invalid quantity.'));
            return $this->redirect($this->referer());

        }
    }

    /**
     * CustomerShoppingCart method
     *
     */
    public function customerShoppingCart()
    {
        $session = $this->request->getSession();
        $cart = $session->read('Cart') ?? []; // Ensuring $cart is always an array
        $flowersTable = TableRegistry::getTableLocator()->get('Flowers');
        $canProceedToCheckout = true;

        foreach ($cart as $index => &$item) {
            try {
                $flower = $flowersTable->get($item['flower_id']);
                // Check if requested quantity exceeds available stock
                if ($item['quantity'] > $flower->stock_quantity) {
                    $item['stock_exceeded'] = true;
                    $canProceedToCheckout = false; // Block checkout if any item exceeds available stock
                    $this->Flash->error(__("The quantity for {$flower->flower_name} exceeds the available stock."));
                } else {
                    $item['stock_exceeded'] = false;
                }
                // Refresh stock info for accuracy
                $item['stock'] = $flower->stock_quantity;
            } catch (\Cake\Datasource\Exception\RecordNotFoundException $e) {
                // Handle case where the flower no longer exists in the database
                unset($cart[$index]);
                $this->Flash->error(__("A flower in your cart could not be found and has been removed."));
                continue;
            }
        }

        // Update the session after potentially modifying cart items
        $session->write('Cart', $cart);

        // Calculate the total price
        $totalPrice = array_sum(array_map(function ($item) {
            return $item['quantity'] * $item['price'];
        }, $cart));

        $this->set(compact('cart', 'totalPrice', 'canProceedToCheckout'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
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

        // Proceed with flowers add function
        $flower = $this->Flowers->newEmptyEntity();
        if ($this->request->is('post')) {
            $flower = $this->Flowers->patchEntity($flower, $this->request->getData());

            // Adding flower image files to be able to be viewed on the customer view
            if(!$flower->getErrors()) {
                $image = $this->request->getData('image_file');
                $name = uniqid().'-'.$image->getClientFilename();

                $image2 = $this->request->getData('image_file2');

                if ($image2 !== null && $image2->getError() !== UPLOAD_ERR_NO_FILE) {
                    $name2 = uniqid().'-'.$image->getClientFilename();
                }

                $targetPath = WWW_ROOT . 'img' . DS . $name;
                if ($name) {
                    $image->moveTo($targetPath);
                    $flower->image = $name;
                }

                if ($image2 !== null && $image2->getError() !== UPLOAD_ERR_NO_FILE) {
                    $targetPath2 = WWW_ROOT . 'img' . DS . $name2;
                    if ($name2 !== null && $image2->getError() !== UPLOAD_ERR_NO_FILE) {
                        $image2->moveTo($targetPath2);
                        $flower->image2 = $name2;
                    }
                }
            }

            $flower->isArchived = 0; // Sets the default isArchived value to be not archived (0)

            // If saving the flower was successful, display the message below
            if ($this->Flowers->save($flower)) {
                $this->Flash->success(__('The flower has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            // If saving the flower was not successful, display the message below
            $this->Flash->error(__('The flower could not be saved. Please, try again.'));
        }
        // Fetch category names for the dropdown
        $categories = $this->Flowers->Categories->find('list', keyField: 'id', valueField: 'category_name');


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

        // Proceed with flowers edit function
        $flower = $this->Flowers->get($id, contain: []);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $flower = $this->Flowers->patchEntity($flower, $this->request->getData());

            // Editing flower image files to be able to be viewed on the customer view
            if(!$flower->getErrors()) {
                $image = $this->request->getData('change_image');
                $image2 = $this->request->getData('change_image2');

                $name = $image->getClientFilename();
                $name2 = $image->getClientFilename();

                if ($name != null && $image->getError() !== UPLOAD_ERR_NO_FILE){
                    $name = uniqid().'-'.$name;
                    $targetPath = WWW_ROOT . 'img' . DS . $name;

                    $image->moveTo($targetPath);
                    $imgpath = WWW_ROOT.'img'.DS.$flower->image;
                    if(file_exists($imgpath)){
                        unlink($imgpath);
                    }
                    $flower->image = $name;
                }

                if ($name2 != null && $image2->getError() !== UPLOAD_ERR_NO_FILE){
                    $name2 = uniqid().'-'.$name2;

                    $targetPath2 = WWW_ROOT . 'img' . DS . $name2;

                    $image2->moveTo($targetPath2);

                    $imgpath2 = WWW_ROOT.'img'.DS.$flower->image2;
                    if(file_exists($imgpath2)){
                        unlink($imgpath2);
                    }
                    $flower->image2 = $name2;
                }
            }

            // If saving the flower was successful, display the message below
            if ($this->Flowers->save($flower)) {
                $this->Flash->success(__('The flower has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            // If saving the flower was not successful, display the message below
            $this->Flash->error(__('The flower could not be saved. Please, try again.'));
        }
        // Fetch category names for the dropdown
        $categories = $this->Flowers->Categories->find('list', limit: 200, keyField: 'id', valueField: 'category_name');

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

        // Proceed with flowers delete function
        $this->request->allowMethod(['post', 'delete']);
        $flower = $this->Flowers->get($id);
        // If deleting the flower was successful, display the message below
        if ($this->Flowers->delete($flower)) {
            $this->Flash->success(__('The flower has been deleted.'));
        } else {
            // If deleting the flower was not successful, display the message below
            $this->Flash->error(__('The flower could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * RemoveFromCart method
     *
     * @param string|null $id Flowers id.
     */
    public function removeFromCart($index)
    {
        $this->request->allowMethod(['post', 'delete']);

        $cart = $this->request->getSession()->read('Cart');
        if (isset($cart[$index])) {
            unset($cart[$index]); // Remove the item from the array
            $this->request->getSession()->write('Cart', $cart); // Save the updated cart back to the session
            // If removing the flower from the cart was successful, display the message below
            $this->Flash->success(__('The item has been removed from your cart.'));
        } else {
            // If removing the flower from the cart was not successful, display the message below
            $this->Flash->error(__('The item could not be found in your cart.'));
        }

        return $this->redirect($this->referer()); // Redirect back to the same page
    }


    /**
     * Archive method
     *
     * @param string|null $id Flowers id.
     * @return \Cake\Http\Response|null|void Redirects on successful archive, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function archive($id = null)
    {
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

        // Proceed with flowers archive function
        $flower = $this->Flowers->get($id, contain: []);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $flower = $this->Flowers->patchEntity($flower, $this->request->getData());

            // Set the flower's isArchived variable to 1, so it is archived
            $flower->isArchived = 1;

            // If archiving the flower was successful, display the message below
            if ($this->Flowers->save($flower)) {
                $this->Flash->success(__('The flower has been unarchived.'));

                return $this->redirect(['action' => 'index']);
            }
            // If archiving the flower was not successful, display the message below
            $this->Flash->error(__('The flower could not be unarchived. Please, try again.'));
        }
        $this->set(compact('flower', 'categories'));
    }

    /**
     * Unarchive method
     *
     * @param string|null $id Flowers id.
     * @return \Cake\Http\Response|null|void Redirects on successful archive, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function unarchive($id = null)
    {
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

        // Proceed with flowers unarchive function
        $flower = $this->Flowers->get($id, contain: []);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $flower = $this->Flowers->patchEntity($flower, $this->request->getData());

            // Set the flower's isArchived variable to 0, so it is unarchived
            $flower->isArchived = 0;

            // If unarchiving the flower was successful, display the message below
            if ($this->Flowers->save($flower)) {
                $this->Flash->success(__('The flower has been unarchived.'));

                return $this->redirect(['action' => 'index']);
            }
            // If unarchiving the flower was not successful, display the message below
            $this->Flash->error(__('The flower could not be unarchived. Please, try again.'));
        }
        $this->set(compact('flower', 'categories'));
    }
}
