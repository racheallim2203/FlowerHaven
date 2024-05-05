<?php
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Http\Exception\NotFoundException;

$this->layout = 'default2';
$this->assign('title', 'Order History');

/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\OrderDelivery> $orders
 *  @var iterable<\App\Model\Entity\Payment> $payments
 */
?>

<header class="site-header section-padding-img site-header-image front-product">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-12 header-info">
                <h1><span class="d-block text-dark bi-bag">Your Orders</span></h1>
            </div>
        </div>
    </div>
</header>

<<div class="container">
    <?= $this->Flash->render() ?>
    <?php if (!empty($payments)): ?>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Payment ID</th>
                            <th>Order Date</th>
                            <th>Payment Method</th>
                            <th>Payment Status</th>
                            <th>Total Amount</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($payments as $payment): ?>
                            <tr>
                                <td><?= h($payment->id) ?></td>
                                <td><?= $payment->order_delivery ? h($payment->order_delivery->order_date->format('F d, Y')) : 'N/A' ?></td>
                                <td><?= $payment->payment_method ? h($payment->payment_method->method_type) : 'N/A' ?></td>
                                <td><?= $payment->payment_status ? h($payment->payment_status->status_type) : 'N/A' ?></td>
                                <td>$<?= $payment->order_delivery ? h($payment->order_delivery->total_amount) : 'N/A' ?></td>
                                <td>
                                    <?= $this->Html->link('Track Order', ['controller' => 'Payments', 'action' => 'view', $payment->id], ['class' => 'btn btn-primary']) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php else: ?>
        <p class="text-center">You have no payments in your history.</p>
    <?php endif; ?>
    <br><br><br><br>
</div>
