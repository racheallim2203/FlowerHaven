<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Payment> $payments
 * @var iterable<\App\Model\Entity\PaymentStatus> $paymentstatus
 * @var iterable<\App\Model\Entity\PaymentMethod> $paymentmethods
 */

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
            <br>
            <div class="bg-white tm-block h-100">
                <div class="table-responsive">
                    <h2 class="text-center" style="font-weight: bold;">Payments</h2>
                    <br>
                    <table class="table table-bordered" style="background-color: #f8f9fa;">
                        <thead>
                        <tr class="table-pink">
                            <th><?= $this->Paginator->sort('id', 'ID', ['style' => 'color: #9e297e;']) ?></th>
                            <th><?= $this->Paginator->sort('orderdelivery_id', 'Order Delivery ID', ['style' => 'color: #9e297e;']) ?></th>
                            <th><?= $this->Paginator->sort('paymentstatus_id', 'Payment Status ID', ['style' => 'color: #9e297e;']) ?></th>
                            <th><?= $this->Paginator->sort('paymentmethod_id', 'Payment Method ID', ['style' => 'color: #9e297e;']) ?></th>
                            <th><?= $this->Paginator->sort('user_id', 'User ID', ['style' => 'color: #9e297e;']) ?></th>
                            <th class="actions" style="color: #9e297e;"><?= __('Actions') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($payments as $payment): ?>
                            <tr>
                                <td><?= h($payment->id) ?></td>
                                <td><?= $this->Html->link(h($payment->orderdelivery_id), ['controller' => 'OrderDeliveries', 'action' => 'view', $payment->orderdelivery_id]) ?></td>
                                <td><?= $payment->payment_status ? h($payment->payment_status->status_type) : __('No Payment Status') ?></td>
                                <td><?= $payment->payment_method ? h($payment->payment_method->method_type) : __('No Payment Method') ?></td>
                                <td><?= $this->Html->link(h($payment->user_id), ['controller' => 'Users', 'action' => 'view', $payment->user_id]) ?></td>
                                <td class="actions">
                                    <?= $this->Html->link(__('View'), ['action' => 'view', $payment->id], ['class' => 'btn btn-info btn-block']) ?>
                                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $payment->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $payment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $payment->id), 'class' => 'btn btn-danger btn-sm']) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="paginator">
                    <ul class="pagination justify-content-center">
                        <?= $this->Paginator->first('<< ' . __('First')) ?>
                        <?= $this->Paginator->prev('< ' . __('Previous')) ?>
                        <?= $this->Paginator->numbers() ?>
                        <?= $this->Paginator->next(__('Next') . ' >') ?>
                        <?= $this->Paginator->last(__('Last') . ' >>') ?>
                    </ul>
                    <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
