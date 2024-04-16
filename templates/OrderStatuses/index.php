<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\OrderStatus> $orderStatuses
 */
?>
<div class="orderStatuses index content">
    <?= $this->Html->link(__('New Order Status'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Order Statuses') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('order_type') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orderStatuses as $orderStatus): ?>
                <tr>
                    <td><?= h($orderStatus->id) ?></td>
                    <td><?= h($orderStatus->order_type) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $orderStatus->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $orderStatus->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $orderStatus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $orderStatus->id)]) ?>
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
