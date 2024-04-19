<?php
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Http\Exception\NotFoundException;

/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Flower> $flowers
 * @var iterable<\App\Model\Entity\Category> $categories
 * @var iterable<\App\Model\Entity\PaymentMethod> $paymentMethods
 * @var iterable<\App\Model\Entity\Payment> $payments
 * @var iterable<\App\Model\Entity\OrderDelivery> $orderdeliveries
 * @var array $cart
 * @var float $totalPrice
 */

$this->request->getSession()->write('Cart', $cart);
$cart = $this->request->getSession()->read('Cart');
$this->layout = 'default2';
$this->assign('title', 'Credit Card Payment Form');
echo $this->Html->css('payment');
?>
<div class="container d-flex justify-content-center mt-5 mb-5">
    <div class="row g-3">
        <div class="col-md-6">
            <?= $this->Form->create(null, [
                'id' => 'paymentForm',
                'url' => ['controller' => 'OrderDeliveries', 'action' => 'processOrder'],
                'type' => 'post'
            ]) ?>
            <div class="card">
                <div class="card-header p-0" id="headingOne">
                    <h2 class="mb-0">
                        <button class="btn btn-light btn-block text-left p-3 rounded-0" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="font-weight: bold">
                            Payment Information
                        </button>
                    </h2>
                </div>
                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">
                        <?= $this->Form->control('payment_method_id', [
                            'label' => 'Payment Method',
                            'options' => $paymentMethods,
                            'empty' => 'Select a method',
                            'required' => true,
                            'class' => 'form-control'
                        ]); ?>
                        <?= $this->Form->control('card_number', [
                            'class' => 'form-control',
                            'placeholder' => '0000 0000 0000 0000',
                            'label' => ['text' => 'Card Number', 'class' => 'font-weight-normal card-text'],
                            'required' => true
                        ]); ?>
                        <?= $this->Form->control('expiry_date', [
                            'class' => 'form-control',
                            'placeholder' => 'MM/YY',
                            'label' => ['text' => 'Expiry Date', 'class' => 'font-weight-normal card-text'],
                            'required' => true
                        ]); ?>
                        <?= $this->Form->control('cvv', [
                            'class' => 'form-control',
                            'placeholder' => '000',
                            'label' => ['text' => 'CVC/CVV', 'class' => 'font-weight-normal card-text'],
                            'required' => true
                        ]); ?>
                        <span class="text-muted certificate-text"><i class="fa fa-lock"></i> Your transaction is secured with SSL encryption.</span>
                    </div>
                </div>
            </div>
            <?= $this->Form->button('Pay $' . h($totalPrice), ['class' => 'btn btn-primary btn-block']) ?>
            <?= $this->Form->end() ?>
        </div>
        <div class="col-md-6">
            <h4>Summary</h4>
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($cart as $item): ?>
                            <tr>
                                <td><?= h($item['name']) ?></td>
                                <td><?= h($item['quantity']) ?></td>
                                <td>$<?= h($item['price']) ?></td>
                                <td>$<?= h($item['quantity'] * $item['price']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <hr>
                    <h5>Subtotal: $<?= h($totalPrice) ?></h5>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#paymentForm').on('submit', function(e) {
            e.preventDefault();
            const formData = $(this).serialize();
            $.ajax({
                url: '/orderdeliveries/processorder',
                type: 'post',
                data: formData,
                dataType: 'json',  // Expecting JSON response
                success: function(data) {
                    console.log('Response data:', data); // Log the response data for debugging
                    if (data.success) {
                        console.log('Order ID:', data.orderDeliveryId); // Log the orderDeliveryId for debugging
                        alert('Payment successful! Your Order ID is: ' + data.orderDeliveryId + '. Thanks for shopping with us!');
                        window.location.href = '/';
                    } else {
                        alert('Error: ' + data.message);
                    }
                },
            });
        });
    });
</script>


