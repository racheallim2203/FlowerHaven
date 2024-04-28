<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Payment $payment
 * @var \Cake\Collection\CollectionInterface|string[] $orderDeliveries
 * @var \Cake\Collection\CollectionInterface|string[] $paymentStatuses
 * @var \Cake\Collection\CollectionInterface|string[] $paymentMethods
 * @var \Cake\Collection\CollectionInterface|string[] $users
 */
?>
<div class="container-fluid">
    <div class="row">
        <aside class="col-xl-3 col-lg-3 col-md-4 col-sm-12">
            <div class="card card-body">
                <div class="card-header" style="color: white; background-color: #ccaf47;">
                    <h4 class="tm-block-title font-weight-bold"><?= __('Actions') ?></h4>
                </div>
                <div class="card-body">
                    <?= $this->Html->link(__('List Payments'), ['action' => 'index'], ['class' => 'btn btn-outline-info btn-block']) ?>
                </div>
            </div>
        </aside>
        <div class="col-xl-9 col-lg-9 col-md-8 col-sm-12">
            <div class="card">
                <div class="card-header text-white" style="background-color: #69064e;">
                    <h4 class="mb-0"><?= __('Add Payment') ?></h4>
                </div>
                <div class="card-body">
                    <?= $this->Form->create($payment) ?>
                    <fieldset>
                        <div class="form-group">
                            <?= $this->Form->control('orderdelivery_id', [
                                'options' => $orderDeliveries,
                                'class' => 'form-control form-control-lg',
                                'label' => 'Order Delivery'
                            ]); ?>
                        </div>
                        <div class="form-group">
                            <?= $this->Form->control('paymentstatus_id', [
                                'options' => $paymentStatuses,
                                'class' => 'form-control form-control-lg',
                                'label' => 'Payment Status'
                            ]); ?>
                        </div>
                        <div class="form-group">
                            <?= $this->Form->control('paymentmethod_id', [
                                'options' => $paymentMethods,
                                'class' => 'form-control form-control-lg',
                                'label' => 'Payment Method'
                            ]); ?>
                        </div>
                        <div class="form-group">
                            <?= $this->Form->control('user_id', [
                                'options' => $users,
                                'class' => 'form-control form-control-lg',
                                'label' => 'User'
                            ]); ?>
                        </div>
                    </fieldset>
                    <div class="form-group mt-4">
                        <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-lg btn-success']) ?>
                    </div>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>
