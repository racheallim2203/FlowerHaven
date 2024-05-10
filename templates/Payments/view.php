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
                            <th><?= __('Order Status') ?></th>
                            <td>
                                <?php if ($payment->order_delivery && $payment->order_delivery->order_status): ?>
                                    <?= h($payment->order_delivery->order_status->order_type) ?>
                                <?php else: ?>
                                    <?= __('Not Available') ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th><?= __('Delivery Status') ?></th>
                            <td>
                                <?php if ($payment->order_delivery && $payment->order_delivery->delivery_status): ?>
                                    <?= h($payment->order_delivery->delivery_status->delivery_status) ?>
                                <?php else: ?>
                                    <?= __('Not Available') ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th><?= __('Total Amount Paid') ?></th>
                            <td>
                                <?php if ($payment->order_delivery && $payment->order_delivery->total_amount): ?>
                                    $<?= h($payment->order_delivery->total_amount) ?>
                                <?php else: ?>
                                    <?= __('Not Available') ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th><?= __('User ID') ?></th>
                            <td>
                                <?= $payment->user ? h($payment->user->id) : __('Not Available') ?>
                            </td>
                        </tr>
                        <tr>
                            <th><?= __('User Email') ?></th>
                            <td>
                                <?= $payment->user ? h($payment->user->email) : __('Not Available') ?>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
