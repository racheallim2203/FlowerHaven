<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Payment $payment
 */
?>
<br>
<div class="container-fluid">
    <div class="row">
        <aside class="col-xl-3 col-lg-3 col-md-4 col-sm-12">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0"><?= __('Actions') ?></h4>
                </div>
                <div class="card-body">
                    <?= $this->Html->link(__('Edit Payment'), ['action' => 'edit', $payment->id], ['class' => 'btn btn-primary btn-block']) ?>
                    <?= $this->Form->postLink(
                        __('Delete Payment'),
                        ['action' => 'delete', $payment->id],
                        ['confirm' => __('Are you sure you want to delete # {0}?', $payment->id), 'class' => 'btn btn-danger btn-block']
                    ) ?>
                    <?= $this->Html->link(__('List Payments'), ['action' => 'index'], ['class' => 'btn btn-info btn-block']) ?>
                    <?= $this->Html->link(__('New Payment'), ['action' => 'add'], ['class' => 'btn btn-success btn-block']) ?>
                </div>
            </div>
        </aside>
        <div class="col-xl-9 col-lg-9 col-md-8 col-sm-12">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0"><?= __('Payment Details') ?></h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tbody>
                        <tr>
                            <th><?= __('ID') ?></th>
                            <td><?= h($payment->id) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Order Delivery ID') ?></th>
                            <td>
                                <?= $payment->has('order_delivery') && !empty($payment->order_delivery->id)
                                    ? $this->Html->link($payment->order_delivery->id, ['controller' => 'OrderDeliveries', 'action' => 'view', $payment->order_delivery->id])
                                    : __('Not Available') ?>
                            </td>
                        </tr>
                        <tr>
                            <th><?= __('Payment Status') ?></th>
                            <td>
                                <?= $payment->has('payment_status') && !empty($payment->payment_status->name)
                                    ? $this->Html->link($payment->payment_status->name, ['controller' => 'PaymentStatuses', 'action' => 'view', $payment->payment_status->id])
                                    : __('Not Available') ?>
                            </td>
                        </tr>
                        <tr>
                            <th><?= __('Payment Method') ?></th>
                            <td>
                                <?= $payment->has('payment_method') && !empty($payment->payment_method->name)
                                    ? $this->Html->link($payment->payment_method->name, ['controller' => 'PaymentMethods', 'action' => 'view', $payment->payment_method->id])
                                    : __('Not Available') ?>
                            </td>
                        </tr>
                        <tr>
                            <th><?= __('User') ?></th>
                            <td>
                                <?= $payment->has('user') && !empty($payment->user->id)
                                    ? $this->Html->link($payment->user->id, ['controller' => 'Users', 'action' => 'view', $payment->user->id])
                                    : __('Not Available') ?>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
