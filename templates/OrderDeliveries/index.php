<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\OrderDelivery> $orderDeliveries
 */
?>

<div class="container-fluid">
    <div class="row">
        <?= $this->Form->create(null, ['type' => 'get', 'class' => 'form-inline']) ?>
        <div class="col-md-4 mb-3">
            <?= $this->Form->control('orderStatusId', [
                'type' => 'select',
                'class' => 'form-control',
                'label' => false,
                'options' => $orderStatuses,
                'empty' => 'Search Order Status',
                'value' => $this->request->getQuery('orderStatusId')
            ]) ?>
        </div>
        <div class="col-md-4 mb-3">
            <?= $this->Form->control('deliveryStatusId', [
                'type' => 'select',
                'class' => 'form-control',
                'label' => false,
                'options' => $deliveryStatuses,
                'empty' => 'Search Delivery Status',
                'value' => $this->request->getQuery('deliveryStatusId')
            ]) ?>
        </div>
        <div class="col-md-4 mb-3 d-flex">
            <?= $this->Form->button(__('Apply Filters'), ['class' => 'btn btn-primary']) ?>
            <?= $this->Html->link('Reset', ['action' => 'index'], ['class' => 'btn btn-secondary ml-2']) ?>
        </div>
        <?= $this->Form->end() ?>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
            <br>
            <div class="bg-white tm-block h-100">
                <div class="table-responsive">
                    <h2 class="text-center" style="font-weight: bold;">Order Deliveries</h2>
                    <br>
                    <table class="table table-bordered" style="background-color: #f8f9fa;">
                        <thead>
                        <tr class="table-pink">
                            <th><?= $this->Paginator->sort('id', 'ID', ['style' => 'color: #9e297e;']) ?></th>
                            <th><?= $this->Paginator->sort('orderstatus_id', 'Order Status', ['style' => 'color: #9e297e;']) ?></th>
                            <th><?= $this->Paginator->sort('deliverystatus_id', 'Delivery Status', ['style' => 'color: #9e297e;']) ?></th>
                            <th><?= $this->Paginator->sort('order_date', 'Order Date', ['style' => 'color: #9e297e;']) ?></th>
                            <th><?= $this->Paginator->sort('total_amount', 'Total Amount', ['style' => 'color: #9e297e;']) ?></th>
                            <th><?= $this->Paginator->sort('delivery_date', 'Delivery Date', ['style' => 'color: #9e297e;']) ?></th>
                            <th class="actions" style="color: #9e297e;"><?= __('Actions') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($orderDeliveries as $orderDelivery): ?>
                            <tr>
                                <td><?= h($orderDelivery->id) ?></td>
                                <td><?= $orderDelivery->order_status->order_type ?></td>
                                <td><?= $orderDelivery->delivery_status->delivery_status ?></td>
                                <td><?= h($orderDelivery->order_date->format('Y-m-d')) ?></td>
                                <td><?= $this->Number->currency($orderDelivery->total_amount) ?></td>
                                <td><?= h($orderDelivery->delivery_date->format('Y-m-d')) ?></td>
                                <td class="actions">
                                    <?= $this->Html->link(__('View'), ['action' => 'view', $orderDelivery->id], ['class' => 'btn btn-info btn-sm']) ?>
                                    <?php if ($orderDelivery->order_status && $orderDelivery->order_status->order_type !== 'Cancelled'): ?>
                                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $orderDelivery->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                    <?php endif; ?>
                                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $orderDelivery->id], ['confirm' => __('Are you sure you want to delete # {0}?', $orderDelivery->id), 'class' => 'btn btn-danger btn-sm']) ?>
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
