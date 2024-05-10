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
 * @property \App\Model\Table\OrderFlowersTable $OrderFlowers
 */
class PaymentsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function adminIndex()
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

        // Proceed with payments adminIndex function
        $query = $this->Payments->find()
            ->contain(['OrderDeliveries', 'PaymentStatuses', 'PaymentMethods', 'Users']);
        $this->set('payments', $this->paginate($query));
    }

    public function index()
    {
        $query = $this->Payments->find()
            ->leftJoinWith('OrderDeliveries')
            ->leftJoinWith('PaymentStatuses')
            ->leftJoinWith('PaymentMethods')
            ->leftJoinWith('Users');
        $payments = $this->paginate($query);

        $paymentMethodsTable = TableRegistry::getTableLocator()->get('PaymentMethods');
        $paymentMethods = $paymentMethodsTable->find('list', keyField: 'id', valueField: 'method_type');
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

        // Proceed with payments view function
        $payment = $this->Payments->get($id, [
            'contain' => ['OrderDeliveries.OrderStatuses', 'OrderDeliveries.DeliveryStatuses', 'PaymentStatuses', 'PaymentMethods', 'Users']
        ]);
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

        // Proceed with payments edit function
        $payment = $this->Payments->get($id, [
            'contain' => ['OrderDeliveries', 'PaymentMethods', 'Users', 'PaymentStatuses'],
        ]);

        $paymentStatuses = $this->Payments->PaymentStatuses->find('list', keyField: 'id', valueField: 'status_type');

        if ($this->request->is(['patch', 'post', 'put'])) {
            $payment = $this->Payments->patchEntity($payment, $this->request->getData());
            if ($this->Payments->save($payment)) {
                $this->Flash->success(__('The payment has been saved.'));
                return $this->redirect(['action' => 'admin-index']);
            }
            $this->Flash->error(__('The payment could not be saved. Please, try again.'));
        }
        $this->set(compact('payment', 'paymentStatuses'));
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

        // Proceed with payments delete function
        $this->request->allowMethod(['post', 'delete']);
        $payment = $this->Payments->get($id);
        if ($this->Payments->delete($payment)) {
            $this->Flash->success(__('The payment has been deleted.'));
        } else {
            $this->Flash->error(__('The payment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'history']);
    }

    public function history()
    {
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {
            $userId = $result->getData()->id;
            $query = $this->Payments->find()
                ->where(['Payments.user_id' => $userId])
                ->contain(['OrderDeliveries' => ['OrderFlowers' => ['Flowers']], 'PaymentStatuses', 'PaymentMethods', 'Users']);

            $this->set('payments', $this->paginate($query));
        } else {
            $this->Flash->error(__('You must be logged in to view this page.'));
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }
    }

    public function cancelOrder($paymentId)
    {
        $this->request->allowMethod(['post']); // Ensure this is a POST request for security

        try {
            // Fetch the payment along with the associated order delivery
            $payment = $this->Payments->get($paymentId, ['contain' => ['OrderDeliveries']]);
        } catch (Exception $e) {
            Log::error('Error fetching payment with ID ' . $paymentId . ': ' . $e->getMessage());
            $this->Flash->error('Error fetching payment.');
            return $this->redirect(['action' => 'history']);
        }

        if (!$payment->order_delivery) {
            $this->Flash->error('Order Delivery not found for this payment.');
            return $this->redirect(['action' => 'history']);
        }

        // Set the order delivery status to 'ORS-00005' (Cancelled)
        $orderDelivery = $payment->order_delivery;
        $orderDelivery->orderstatus_id = 'ORS-00005'; // Cancelled status

        // Set payment status to 'PAS-00003' (Waiting to Refund)
        $payment->paymentstatus_id = 'PAS-00003'; // Waiting to Refund status

        // Set the delivery status to 'ORS-00005' (Cancelled)
        $orderDelivery->deliverystatus_id = 'DEL-00005'; // Cancelled status

        if ($this->Payments->OrderDeliveries->save($orderDelivery) && $this->Payments->save($payment)) {
            $this->Flash->success('Order and payment status have been successfully updated.');
        } else {
            $this->Flash->error('Failed to update order and payment status.');
        }

        return $this->redirect(['action' => 'history']);
    }
}
