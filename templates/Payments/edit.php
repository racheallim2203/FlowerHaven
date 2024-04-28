<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Payment $payment
 * @var string[]|\Cake\Collection\CollectionInterface $paymentStatuses
 */
?>
<div class="container-fluid">
    <div class="row">
        <aside class="col-md-4">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0"><?= __('Actions') ?></h4>
                </div>
                <div class="card-body">
                    <?= $this->Form->postLink(
                        __('Delete Payment'),
                        ['action' => 'delete', $payment->id],
                        ['confirm' => __('Are you sure you want to delete this payment?'), 'class' => 'btn btn-outline-danger btn-block']
                    ) ?>
                </div>
            </div>
        </aside>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0"><?= __('Edit Payment Status') ?></h4>
                </div>
                <div class="card-body">
                    <?= $this->Form->create($payment) ?>
                    <fieldset>
                        <legend><?= __('Update Payment Status') ?></legend>
                        <!-- Display other fields as static text -->
                        <div class="form-group">
                            <label><?= __('Order Delivery ID') ?></label>
                            <input type="text" class="form-control" value="<?= h($payment->orderdelivery_id) ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label><?= __('Payment Method') ?></label>
                            <input type="text" class="form-control" value="<?= h($payment->paymentmethod_id) ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label><?= __('User') ?></label>
                            <input type="text" class="form-control" value="<?= h($payment->user_id) ?>" readonly>
                        </div>
                        <?= $this->Form->control('paymentstatus_id', [
                            'options' => $paymentStatuses,
                            'class' => 'form-control form-control-lg',
                            'label' => ['text' => 'Payment Status', 'class' => 'form-label mt-4']
                        ]); ?>
                    </fieldset>
                    <div class="form-group mt-4">
                        <?= $this->Form->button(__('Update Status'), ['class' => 'btn btn-lg btn-success']) ?>
                    </div>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>
