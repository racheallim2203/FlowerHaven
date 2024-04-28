<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrderDelivery $orderDelivery
 * @var string[]|\Cake\Collection\CollectionInterface $orderstatuses
 * @var string[]|\Cake\Collection\CollectionInterface $deliveryStatuses
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
                        __('Delete Order Delivery'),
                        ['action' => 'delete', $orderDelivery->id],
                        ['confirm' => __('Are you sure you want to delete this order delivery?'), 'class' => 'btn btn-outline-danger btn-block']
                    ) ?>
                    <?= $this->Html->link(__('All Order Deliveries'), ['action' => 'index'], ['class' => 'btn btn-outline-info btn-block']) ?>
                </div>
            </div>
        </aside>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0"><?= __('Edit Order Delivery') ?></h4>
                </div>
                <div class="card-body">
                    <?= $this->Form->create($orderDelivery) ?>
                    <fieldset>
                        <legend><?= __('Update Order and Delivery Status') ?></legend>
                        <?= $this->Form->control('orderstatus_id', [
                            'options' => $orderstatuses,
                            'class' => 'form-control form-control-lg',
                            'label' => ['text' => 'Order Status', 'class' => 'form-label mt-4']
                        ]); ?>
                        <?= $this->Form->control('deliverystatus_id', [
                            'options' => $deliveryStatuses,
                            'class' => 'form-control form-control-lg',
                            'label' => ['text' => 'Delivery Status', 'class' => 'form-label mt-4']
                        ]); ?>

                        <!-- Display other fields as static text -->
                        <div class="form-group">
                            <label><?= __('Order Date') ?></label>
                            <input type="text" class="form-control" value="<?= h($orderDelivery->order_date) ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label><?= __('Total Amount') ?></label>
                            <input type="text" class="form-control" value="<?= $this->Number->format($orderDelivery->total_amount) ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label><?= __('Delivery Date') ?></label>
                            <input type="text" class="form-control" value="<?= h($orderDelivery->delivery_date) ?>" readonly>
                        </div>
                    </fieldset>
                    <div class="form-group mt-4">
                        <?= $this->Form->button(__('Update Order Delivery'), ['class' => 'btn btn-lg btn-success']) ?>
                    </div>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>
