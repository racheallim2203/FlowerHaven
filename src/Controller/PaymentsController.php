<?php
declare(strict_types=1);
namespace App\Controller;
use Cake\Event\EventInterface;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;

/**
 * Payments Controller
 *
 * @property \App\Model\Table\PaymentsTable $Payments
 * @property \App\Model\Table\PaymentMethodsTable $PaymentMethods
 */
class PaymentsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index() {
        $payments = $this->paginate($this->Payments->find()
            ->contain(['OrderDeliveries', 'PaymentStatuses', 'PaymentMethods', 'Users']));

        $paymentMethodsTable = TableRegistry::getTableLocator()->get('PaymentMethods');
        $paymentMethods = $paymentMethodsTable->find('list', [
            'keyField' => 'id',
            'valueField' => 'method_type'
        ])->toArray();

        // Retrieve the cart from session
        $session = $this->request->getSession();
        $cart = $session->read('Cart') ?? [];

        if (empty($cart)) {
            $this->Flash->error(__('Your cart is empty.'));
            return $this->redirect(['controller' => 'Flowers', 'action' => 'customerIndex']); // Assuming this is the correct redirect
        }

        // Calculate the total price
        $totalPrice = array_sum(array_map(function ($item) {
            return $item['quantity'] * $item['price'];
        }, $cart));

        $this->set(compact('paymentMethods', 'payments', 'cart', 'totalPrice'));
    }


    /**
     * View method
     *
     * @param string|null $id Payment id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $payment = $this->Payments->get($id, contain: ['OrderDeliveries', 'PaymentStatuses', 'PaymentMethods', 'Users']);
        $this->set(compact('payment'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $payment = $this->Payments->newEmptyEntity();
        if ($this->request->is('post')) {
            $payment = $this->Payments->patchEntity($payment, $this->request->getData());
            if ($this->Payments->save($payment)) {
                $this->Flash->success(__('The payment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The payment could not be saved. Please, try again.'));
        }
        $orderDeliveries = $this->Payments->OrderDeliveries->find('list', limit: 200)->all();
        $paymentStatuses = $this->Payments->PaymentStatuses->find('list', limit: 200)->all();
        $paymentMethods = $this->Payments->PaymentMethods->find('list', limit: 200)->all();
        $users = $this->Payments->Users->find('list', limit: 200)->all();
        $this->set(compact('payment', 'orderDeliveries', 'paymentStatuses', 'paymentMethods', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Payment id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $payment = $this->Payments->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $payment = $this->Payments->patchEntity($payment, $this->request->getData());
            if ($this->Payments->save($payment)) {
                $this->Flash->success(__('The payment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The payment could not be saved. Please, try again.'));
        }
        $orderDeliveries = $this->Payments->OrderDeliveries->find('list', limit: 200)->all();
        $paymentStatuses = $this->Payments->PaymentStatuses->find('list', limit: 200)->all();
        $paymentMethods = $this->Payments->PaymentMethods->find('list', limit: 200)->all();
        $users = $this->Payments->Users->find('list', limit: 200)->all();
        $this->set(compact('payment', 'orderDeliveries', 'paymentStatuses', 'paymentMethods', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Payment id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $payment = $this->Payments->get($id);
        if ($this->Payments->delete($payment)) {
            $this->Flash->success(__('The payment has been deleted.'));
        } else {
            $this->Flash->error(__('The payment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function processPayment()
    {
        $session = $this->request->getSession();
        $cart = $session->read('Cart');
        if (empty($cart)) {
            $this->Flash->error(__('Your cart is empty.'));
            return $this->redirect(['controller' => 'Flowers', 'action' => 'customerIndex']);
        }

        $payment = $this->Payments->newEmptyEntity();
        if ($this->request->is('post')) {
            $payment = $this->Payments->patchEntity($payment, $this->request->getData());
            if ($this->Payments->save($payment)) {
                $this->Flash->success(__('Payment processed successfully.'));
                // Clear cart after successful order
                $session->delete('Cart');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Failed to process payment. Please, try again.'));
            }
        }

        $this->set(compact('payment'));
    }


    private function updateStock($cart)
    {
        $flowersTable = TableRegistry::getTableLocator()->get('Flowers');
        foreach ($cart as $item) {
            $flower = $flowersTable->get($item['flower_id']);
            $flower->stock_quantity -= $item['quantity'];
            $flowersTable->save($flower);
        }
    }

    private function simulatePaymentProcessing($amount)
    {
        // Simulate payment gateway processing
        return true; // Simulate a successful payment
    }

    public function confirmation($orderId)
    {
        $order = $this->Payments->OrderDeliveries->get($orderId);
        $this->set(compact('order'));
    }


}
