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
        $query = $this->Flowers->find('all', [
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

        // Fetch category names for the dropdown
        $categories = $this->Flowers->Categories->find('list', [
            'keyField' => 'id',
            'valueField' => 'category_name'
        ]);

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

    public function updateCart()
    {
        $session = $this->request->getSession();
        $cart = $session->read('Cart');
        $updatedCart = $this->request->getData('cart');

        foreach ($updatedCart as $index => $item) {
            if (isset($cart[$index])) {
                $cart[$index]['quantity'] = max(1, (int) $item['quantity']); // Ensure a minimum of 1
            }
        }

        $session->write('Cart', $cart);
        $this->Flash->success('Cart updated successfully.');
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
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $flowerId = $data['flower_id'];
            $quantity = (int)$data['quantity'];  // Cast to ensure it's an integer
            $flower = $this->Flowers->get($flowerId);

            if ($flower->stock_quantity >= $quantity && $quantity > 0) {
                $cart = $this->request->getSession()->read('Cart') ?: [];
                if (isset($cart[$flowerId])) {
                    $cart[$flowerId]['quantity'] += $quantity;  // Update quantity
                } else {
                    $cart[$flowerId] = [
                        'flower_id' => $flowerId,
                        'quantity' => $quantity,
                        'price' => $flower->flower_price,
                        'name' => $flower->flower_name
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
    }


    public function customerShoppingCart()
    {
        $cart = $this->request->getSession()->read('Cart');

        // Check if the cart is empty and set a message
        if (empty($cart)) {
            $this->Flash->error(__('Your shopping cart is empty.'));
        } else {
            // Calculate the total price for the cart if it's not empty
            $totalPrice = array_sum(array_map(function ($item) {
                return $item['quantity'] * $item['price'];
            }, $cart));

            // Pass the total price to the view
            $this->set('totalPrice', $totalPrice);
        }

        $this->set('cart', $cart);
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

    public function removeFromCart($index)
    {
        $session = $this->request->getSession();
        $cart = $session->read('Cart');

        if (isset($cart[$index])) {
            unset($cart[$index]);  // Remove the item from the cart
            $session->write('Cart', $cart);
            $this->Flash->success(__('Item removed from cart.'));
        } else {
            $this->Flash->error(__('Item could not be found in your cart.'));
        }

        return $this->redirect(['action' => 'customerShoppingCart']);
    }

}
