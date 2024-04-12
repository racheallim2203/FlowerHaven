<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\OrderDelivery> $orderDelivery
 */
?>
<div class="orderDelivery index content">
    <?= $this->Html->link(__('New Order Delivery'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Order Delivery') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('orderstatus_id') ?></th>
                    <th><?= $this->Paginator->sort('deliverystatus_id') ?></th>
                    <th><?= $this->Paginator->sort('order_date') ?></th>
                    <th><?= $this->Paginator->sort('total_amount') ?></th>
                    <th><?= $this->Paginator->sort('delivery_date') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orderDelivery as $orderDelivery): ?>
                <tr>
                    <td><?= h($orderDelivery->id) ?></td>
                    <td><?= $orderDelivery->hasValue('order_status') ? $this->Html->link($orderDelivery->order_status->id, ['controller' => 'OrderStatus', 'action' => 'view', $orderDelivery->order_status->id]) : '' ?></td>
                    <td><?= $orderDelivery->hasValue('delivery_status') ? $this->Html->link($orderDelivery->delivery_status->id, ['controller' => 'DeliveryStatus', 'action' => 'view', $orderDelivery->delivery_status->id]) : '' ?></td>
                    <td><?= h($orderDelivery->order_date) ?></td>
                    <td><?= $this->Number->format($orderDelivery->total_amount) ?></td>
                    <td><?= h($orderDelivery->delivery_date) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $orderDelivery->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $orderDelivery->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $orderDelivery->id], ['confirm' => __('Are you sure you want to delete # {0}?', $orderDelivery->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
