<?php
/**
 * @var \App\View\AppView $this
 */
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
    <br><br>
    <div class="container">
        <h1>Shopping Cart</h1>
        <?php if (!empty($cart)): ?>
            <table class="table">
                <thead>
                <tr>
                    <th>Flower Name</th>
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
            <div class="text-right mt-3">
                <?= $this->Html->link('Checkout', ['controller' => 'OrderFlowers', 'action' => 'processOrder'], ['class' => 'btn btn-success']) ?>
            </div>
        <?php else: ?>
            <p>Your cart is empty.</p>
        <?php endif; ?>
    </div>
    <br><br>

</div>
