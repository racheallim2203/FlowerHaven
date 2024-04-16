<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrderFlower $orderFlower
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Order Flowers'), ['action' => 'edit', $orderFlower->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Order Flowers'), ['action' => 'delete', $orderFlower->id], ['confirm' => __('Are you sure you want to delete # {0}?', $orderFlower->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Order Flowers'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Order Flowers'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="orderFlower view content">
            <h3><?= h($orderFlower->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= h($orderFlower->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Flowers') ?></th>
                    <td><?= $orderFlower->hasValue('flower') ? $this->Html->link($orderFlower->flower->id, ['controller' => 'Flowers', 'action' => 'view', $orderFlower->flower->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Order Delivery') ?></th>
                    <td><?= $orderFlower->hasValue('order_delivery') ? $this->Html->link($orderFlower->order_delivery->id, ['controller' => 'OrderDelivery', 'action' => 'view', $orderFlower->order_delivery->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Quantity') ?></th>
                    <td><?= $this->Number->format($orderFlower->quantity) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
