<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\OrderFlower> $orderFlower
 */
?>
<div class="orderFlower index content">
    <?= $this->Html->link(__('New Order Flowers'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Order Flowers') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('flower_id') ?></th>
                    <th><?= $this->Paginator->sort('orderdelivery_id') ?></th>
                    <th><?= $this->Paginator->sort('quantity') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orderFlower as $orderFlower): ?>
                <tr>
                    <td><?= h($orderFlower->id) ?></td>
                    <td><?= $orderFlower->hasValue('flower') ? $this->Html->link($orderFlower->flower->id, ['controller' => 'Flowers', 'action' => 'view', $orderFlower->flower->id]) : '' ?></td>
                    <td><?= $orderFlower->hasValue('order_delivery') ? $this->Html->link($orderFlower->order_delivery->id, ['controller' => 'OrderDelivery', 'action' => 'view', $orderFlower->order_delivery->id]) : '' ?></td>
                    <td><?= $this->Number->format($orderFlower->quantity) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $orderFlower->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $orderFlower->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $orderFlower->id], ['confirm' => __('Are you sure you want to delete # {0}?', $orderFlower->id)]) ?>
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
