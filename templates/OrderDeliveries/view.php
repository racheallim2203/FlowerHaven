<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrderDelivery $orderDelivery
 * @var \App\Model\Entity\OrderStatus $orderStatus
 *  * @var \App\Model\Entity\DeliveryStatus $deliveryStatus
 */
?>
<div class="container-fluid">
    <div class="row">
        <aside class="col-xl-3 col-lg-3 col-md-4 col-sm-12">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0"><?= __('Actions') ?></h4>
                </div>
                <div class="card-body">
                    <?= $this->Html->link(__('Edit Order Delivery'), ['action' => 'edit', $orderDelivery->id], ['class' => 'btn btn-outline-primary btn-block']) ?>
                    <?= $this->Form->postLink(__('Delete Order Delivery'), ['action' => 'delete', $orderDelivery->id], ['confirm' => __('Are you sure you want to delete # {0}?', $orderDelivery->id), 'class' => 'btn btn-outline-danger btn-block']) ?>
                </div>
            </div>
        </aside>
        <div class="col-xl-9 col-lg-9 col-md-8 col-sm-12">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0"><?= __('View Order Delivery') ?></h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <td><?= h($orderDelivery->id) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Order Status') ?></th>
                            <td>
                                <?php if ($orderDelivery->order_status): ?>
                                    <?= h($orderDelivery->order_status->order_type) ?>
                                <?php else: ?>
                                    <?= __('No Order Status') ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th><?= __('Delivery Status') ?></th>
                            <td>
                                <?php if ($orderDelivery->delivery_status): ?>
                                    <?= h($orderDelivery->delivery_status->delivery_status) ?>
                                <?php else: ?>
                                    <?= __('No Delivery Status') ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th><?= __('Total Amount') ?></th>
                            <td><?= $this->Number->format($orderDelivery->total_amount) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Order Date') ?></th>
                            <td><?= h($orderDelivery->order_date) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Delivery Date') ?></th>
                            <td><?= h($orderDelivery->delivery_date) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Payment Statuses') ?></th>
                            <td>
                                <?php foreach ($orderDelivery->payments as $payment): ?>
                                    <?= h($payment->payment_status->status_type) ?><br>
                                <?php endforeach; ?>
                            </td>
                        </tr>
                        <tr>
                            <th><?= __('Payment Methods') ?></th>
                            <td>
                                <?php foreach ($orderDelivery->payments as $payment): ?>
                                    <?= h($payment->payment_method->method_type) ?><br>
                                <?php endforeach; ?>
                            </td>
                        </tr>
                        <tr>
                            <th><?= __('Customer ID') ?></th>
                            <td>
                                <?php foreach ($orderDelivery->payments as $payment): ?>
                                    <?= $this->Html->link($payment->user->id, ['controller' => 'Users', 'action' => 'view', $payment->user->id]) ?><br>
                                <?php endforeach; ?>
                            </td>
                        </tr>
                        <tr>
                            <th><?= __('Customer Email') ?></th>
                            <td>
                                <?php foreach ($orderDelivery->payments as $payment): ?>
                                    <?= h($payment->user->email) ?><br>  <!-- Displaying user email instead of ID -->
                                <?php endforeach; ?>
                            </td>
                        </tr>
                        <tr>
                            <th><?= __('Archived') ?></th>
                            <td><?= $orderDelivery->isArchived ? __('Yes') : __('No') ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- New Section for Customer Purchases -->
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <h4 class="font-weight-bold"><?= __('Customer Purchases') ?></h4>
                </div>
                <?php if (!empty($orderDelivery->order_flowers)) : ?>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th><?= __('Order Delivery ID') ?></th>
                                    <th><?= __('Flower ID') ?></th>
                                    <th><?= __('Flower Name') ?></th>
                                    <th><?= __('Quantity') ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($orderDelivery->order_flowers as $orderFlower) : ?>
                                    <tr>
                                        <td><?= h($orderFlower->orderdelivery_id) ?></td>
                                        <td><?= $this->Html->link($orderFlower->flower->id, ['controller' => 'Flowers', 'action' => 'view', $orderFlower->flower->id]) ?></td>
                                        <td><?= h($orderFlower->flower->flower_name) ?></td>
                                        <td><?= h($orderFlower->quantity) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="card-body">
                        <p class="text-muted"><?= __('No purchases found.') ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
