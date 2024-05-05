<?php
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Http\Exception\NotFoundException;

$this->layout = 'default2';
$this->assign('title', 'Shopping Cart');
?>

<header class="site-header section-padding-img site-header-image front-product">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-12 header-info">
                <h1>
                    <span class="d-block text-dark bi-cart" > Your Cart</span>
                </h1>
            </div>
        </div>
    </div>
</header>

<div class="container">
    <div class="column column-50 column-offset-25">
    <?= $this->Flash->render() ?>
    <?php if (!empty($cart)): ?>
        <?= $this->Form->create(null, ['url' => ['action' => 'updateCart']]) ?>
        <table class="table">
            <thead>
            <tr>
                <th>Flower Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($cart as $index => $item): ?>
                <tr class="<?= $item['stock_exceeded'] ? 'table-danger' : '' ?>">
                    <td><?= h($item['name']) ?></td>
                    <td>
                        <?= $this->Form->create(null, ['url' => ['action' => 'updateCart', $index]]) ?>
                        <?= $this->Form->control("cart[$index][quantity]", [
                            'type' => 'number',
                            'label' => false,
                            'value' => $item['quantity'],
                            'min' => 1,
                            'class' => 'form-control'
                        ]); ?>
                        <?= $this->Form->button(__('Update'), ['class' => 'btn btn-info']) ?>
                        <?= $this->Form->end() ?>
                    </td>
                    <td>$<?= h($item['price']) ?></td>
                    <td>$<?= h($item['quantity'] * $item['price']) ?></td>
                    <td>
                        <?php if ($item['stock_exceeded']): ?>
                            <span class="text-danger">Stock limit exceeded!</span>
                        <?php else: ?>
                            <span class="text-success">In stock</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?= $this->Form->create(null, ['url' => ['action' => 'removeFromCart', $index], 'class' => 'remove-form']) ?>
                        <?= $this->Form->button(__('Remove'), ['confirm' => 'Are you sure you want to remove this item from your cart?','class' => 'btn btn-danger', 'type' => 'submit']) ?>
                        <?= $this->Form->end() ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <?= $this->Form->end() ?>
        <p>Total Price: $<?= h($totalPrice) ?></p>
        <?php if ($canProceedToCheckout): ?>
            <?= $this->Html->link('Checkout', ['controller' => 'Payments', 'action' => 'index'], ['class' => 'btn btn-success']) ?>
        <?php else: ?>
            <button class="btn btn-success" disabled>Checkout</button>
            <div class="alert alert-warning">Please adjust your cart to proceed to checkout.</div>
        <?php endif; ?>
    <?php else: ?>
        <br>
        <p>Your cart is empty.</p>
        <br><br><br><br><br><br><br><br>
    <?php endif; ?>
    <br><br>
</div>


