<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Payment> $payment
 */
?>
<div class="payment index content">
    <?= $this->Html->link(__('New Payment'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Payment') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('orderdelivery_id') ?></th>
                    <th><?= $this->Paginator->sort('paymentstatus_id') ?></th>
                    <th><?= $this->Paginator->sort('paymentmethod_id') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($payment as $payment): ?>
                <tr>
                    <td><?= h($payment->id) ?></td>
                    <td><?= $payment->hasValue('order_delivery') ? $this->Html->link($payment->order_delivery->id, ['controller' => 'OrderDelivery', 'action' => 'view', $payment->order_delivery->id]) : '' ?></td>
                    <td><?= $payment->hasValue('payment_status') ? $this->Html->link($payment->payment_status->id, ['controller' => 'PaymentStatus', 'action' => 'view', $payment->payment_status->id]) : '' ?></td>
                    <td><?= $payment->hasValue('payment_method') ? $this->Html->link($payment->payment_method->id, ['controller' => 'PaymentMethod', 'action' => 'view', $payment->payment_method->id]) : '' ?></td>
                    <td><?= $payment->hasValue('user') ? $this->Html->link($payment->user->id, ['controller' => 'User', 'action' => 'view', $payment->user->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $payment->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $payment->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $payment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $payment->id)]) ?>
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
