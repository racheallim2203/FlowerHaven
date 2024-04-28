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
        $this->Authentication->allowUnauthenticated(['customerView', 'customerIndex', 'addToCart', 'customerShoppingCart']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Flowers->find('all', contain: ['Categories'], order: ['Flowers.stock_quantity' => 'asc']);
        $search = $this->request->getQuery('search');
        $category = $this->request->getQuery('category');

        if (!empty($search)) {
            $query->where(['Flowers.flower_name LIKE' => '%' . $search . '%']);
        }

        if (!empty($category)) {
            $query->where(['Categories.id' => $category]);
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
        $flower = $this->Flowers->get($id, contain: ['Categories', 'OrderFlowers']);
        $this->set(compact('flower'));
    }

    public function customerIndex()
    {
        $query = $this->Flowers->find('all', contain: ['Categories']);
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

    public function updateCart()
    {
        $session = $this->request->getSession();
        $cart = $session->read('Cart');
        $updatedCart = $this->request->getData('cart');
        $flowersTable = TableRegistry::getTableLocator()->get('Flowers');
        $errors = false;  // Track if any errors occurred

        foreach ($updatedCart as $index => $item) {
            $requestedQuantity = (int) $item['quantity'];
            if ($requestedQuantity <= 0) {
                // Remove item if quantity is zero or less
                unset($cart[$index]);
                continue;
            }

            try {
                $flower = $flowersTable->get($index);
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
                $this->Flash->success(__('Cart updated successfully.'));
            }
        } else {
            $session->delete('Cart');
            $this->Flash->error(__('Your cart is empty.'));
        }

        return $this->redirect(['action' => 'customerShoppingCart']);
    }


    public function updateStock()
    {
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cart = $this->request->getData('cart');
            $flowersTable = TableRegistry::getTableLocator()->get('Flowers');

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

            $this->Flash->success(__('Cart updated successfully.'));
            return $this->redirect(['action' => 'customerShoppingCart']);
        }
        $this->Flash->error(__('Invalid request.'));
        return $this->redirect(['action' => 'customerShoppingCart']);
    }

    public function addToCart()
    {
        $data = $this->request->getData();
        $flowerId = $data['flower_id'];
        $quantity = (int)$data['quantity'];
        $flower = $this->Flowers->get($flowerId);

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
            $this->Flash->success(__('Successfully added to cart.'));
            return $this->redirect(['controller' => 'Flowers', 'action' => 'customerShoppingCart']);
        } else {
            $this->Flash->error(__('Not enough stock available or invalid quantity.'));
            return $this->redirect($this->referer());
        }


}
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
        $flower = $this->Flowers->newEmptyEntity();
        if ($this->request->is('post')) {
            $flower = $this->Flowers->patchEntity($flower, $this->request->getData());

            if(!$flower->getErrors()) {
                $image = $this->request->getData('image_file');
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
        // Fetch category names for the dropdown
        $categories = $this->Flowers->Categories->find('list', [
            'keyField' => 'id',
            'valueField' => 'category_name'
        ]);

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

            if(!$flower->getErrors()) {
                $image = $this->request->getData('change_image');
                $name = $image->getClientFilename();

                if ($name){
                    $targetPath = WWW_ROOT . 'img' . DS . $name;

                    $image->moveTo($targetPath);
                    $imgpath = WWW_ROOT.'img'.DS.$flower->image;
                    if(file_exists($imgpath)){
                        unlink($imgpath);
                    }
                    $flower->image = $name;
                }
            }


            if ($this->Flowers->save($flower)) {
                $this->Flash->success(__('The flower has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The flower could not be saved. Please, try again.'));
        }
        $categories = $this->Flowers->Categories->find('list', [
            'limit' => 200,
            'keyField' => 'id',
            'valueField' => 'category_name'
        ]);
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


    public function removeFromCart($index)
    {
        $this->request->allowMethod(['post', 'delete']);

        $cart = $this->request->getSession()->read('Cart');
        if (isset($cart[$index])) {
            unset($cart[$index]); // Remove the item from the array
            $this->request->getSession()->write('Cart', $cart); // Save the updated cart back to the session
            $this->Flash->success(__('The item has been removed from your cart.'));
        } else {
            $this->Flash->error(__('The item could not be found in your cart.'));
        }

        return $this->redirect($this->referer()); // Redirect back to the same page
    }
}
