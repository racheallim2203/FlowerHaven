<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Payment $payment
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Payment'), ['action' => 'edit', $payment->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Payment'), ['action' => 'delete', $payment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $payment->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Payment'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Payment'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="payment view content">
            <h3><?= h($payment->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= h($payment->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Order Delivery') ?></th>
                    <td><?= $payment->hasValue('order_delivery') ? $this->Html->link($payment->order_delivery->id, ['controller' => 'OrderDelivery', 'action' => 'view', $payment->order_delivery->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Payment Status') ?></th>
                    <td><?= $payment->hasValue('payment_status') ? $this->Html->link($payment->payment_status->id, ['controller' => 'PaymentStatus', 'action' => 'view', $payment->payment_status->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Payment Method') ?></th>
                    <td><?= $payment->hasValue('payment_method') ? $this->Html->link($payment->payment_method->id, ['controller' => 'PaymentMethod', 'action' => 'view', $payment->payment_method->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $payment->hasValue('user') ? $this->Html->link($payment->user->id, ['controller' => 'User', 'action' => 'view', $payment->user->id]) : '' ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
