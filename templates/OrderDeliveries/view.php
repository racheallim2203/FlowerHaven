<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrderDelivery $orderDelivery
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Order Delivery'), ['action' => 'edit', $orderDelivery->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Order Delivery'), ['action' => 'delete', $orderDelivery->id], ['confirm' => __('Are you sure you want to delete # {0}?', $orderDelivery->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Order Deliveries'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Order Delivery'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="orderDeliveries view content">
            <h3><?= h($orderDelivery->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= h($orderDelivery->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Orderstatus') ?></th>
                    <td><?= $orderDelivery->hasValue('orderstatus') ? $this->Html->link($orderDelivery->orderstatus->id, ['controller' => 'OrderStatuses', 'action' => 'view', $orderDelivery->orderstatus->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Delivery Status') ?></th>
                    <td><?= $orderDelivery->hasValue('delivery_status') ? $this->Html->link($orderDelivery->delivery_status->id, ['controller' => 'DeliveryStatuses', 'action' => 'view', $orderDelivery->delivery_status->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Total Amount') ?></th>
                    <td><?= $this->Number->format($orderDelivery->total_amount) ?></td>
                </tr>
                <tr>
                    <th><?= __('Order Date') ?></th>
                    <td><?= h($orderDelivery->order_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Delivery Date') ?></th>
                    <td><?= h($orderDelivery->delivery_date) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
