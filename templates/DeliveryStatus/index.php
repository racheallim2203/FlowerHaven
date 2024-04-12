<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\DeliveryStatus> $deliveryStatus
 */
?>
<div class="deliveryStatus index content">
    <?= $this->Html->link(__('New Delivery Status'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Delivery Status') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('delivery_status') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($deliveryStatus as $deliveryStatus): ?>
                <tr>
                    <td><?= h($deliveryStatus->id) ?></td>
                    <td><?= h($deliveryStatus->delivery_status) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $deliveryStatus->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $deliveryStatus->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $deliveryStatus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $deliveryStatus->id)]) ?>
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
