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
<div class="container">
    <h1>Shopping Cart</h1>
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
                        <?= $this->Form->control("cart[$index][quantity]", [
                            'type' => 'number',
                            'label' => false,
                            'value' => $item['quantity'],
                            'min' => 1,
                            'class' => 'form-control'
                        ]); ?>
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
                        <?= $this->Form->button(__('Update'), ['class' => 'btn btn-info']) ?>
                        <?= $this->Form->postLink(__('Remove'), ['action' => 'removeFromCart', $index], [
                            'confirm' => 'Are you sure?',
                            'class' => 'btn btn-danger'
                        ]) ?>
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
        <p>Your cart is empty.</p>
    <?php endif; ?>
    <br><br>
</div>

