<?php
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Http\Exception\NotFoundException;

$this->layout = 'default2';
$this->assign('title', 'Payment');
?>
<div class="container">
    <br><br>
    <?= $this->Flash->render() ?>
    <h1>Shopping Cart</h1>

    <?php if (!empty($cart)): ?>
        <?= $this->Form->create(null, ['url' => ['controller' => 'Flowers', 'action' => 'updateStock']]) ?>
        <table class="table">
            <thead>
            <tr>
                <th>Flower Name</th>
                <th>Quantity / Remove</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
            </thead>
            <tbody>
            <?php $totalPrice = 0; ?>
            <?php foreach ($cart as $index => $item): ?>
                <tr>
                    <td><?= h($item['name']) ?></td>
                    <td>
                        <?= $this->Form->control("cart.$index.quantity", [
                            'label' => false,
                            'type' => 'select',
                            'options' => range(0, $item['stock'] ?? 5),
                            'default' => $item['quantity'],
                            'class' => 'form-select'
                        ]) ?>
                        <?= $this->Form->button('Remove', [
                            'type' => 'submit',
                            'formaction' => $this->Url->build(['action' => 'removeFromCart', $index]),
                            'class' => 'btn btn-danger btn-sm',
                            'onClick' => 'return confirm("Are you sure you want to remove this item?");'
                        ]) ?>
                    </td>
                    <td>$<?= h($item['price']) ?></td>
                    <td>$<?= h($item['quantity'] * $item['price']) ?>
                        <?php $totalPrice += $item['quantity'] * $item['price']; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <p>Total Price: $<?= h($totalPrice) ?></p>
        <?= $this->Form->button('Update Cart', ['class' => 'btn btn-primary']) ?>
        <?= $this->Form->end() ?>
        <div class="text-right mt-3">
            <?= $this->Html->link('Checkout', ['controller' => 'OrderDeliveries', 'action' => 'processOrder'], ['class' => 'btn btn-success']) ?>
        </div>
    <?php else: ?>
        <p>Your cart is empty.</p>
    <?php endif; ?>
    <br><br>
</div>
