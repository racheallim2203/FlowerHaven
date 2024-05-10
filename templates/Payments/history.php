<?php
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Http\Exception\NotFoundException;
echo $this->Html->css('order');
$this->layout = 'default2';
$this->assign('title', 'Order History');

/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\OrderDelivery> $orders
 *  @var iterable<\App\Model\Entity\Payment> $payments
 * @var iterable<\App\Model\Entity\Flower> $flowers
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

<div class="container">
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
                                    <div>
                                        <?= $this->Html->link(
                                            'Track Order',
                                            [
                                                'controller' => 'Payments',
                                                'action' => 'history',
                                                $payment->id
                                            ],
                                            [
                                                'class' => 'btn btn-secondary btn-sm', // Button classes
                                                'data-toggle' => 'modal',            // For opening a modal
                                                'data-target' => '#myModal' . $payment->id,
                                                'style' => 'background-color: #9e297e;'
                                            ]
                                        ) ?>
                                    </div>
                                    <div class="mt-2">
                                        <?= $this->Html->link('View Invoice',
                                            [
                                                'controller' => 'Payments',
                                                'action' => 'history',
                                                $payment->id
                                            ], [
                                                'class' => 'btn btn-primary btn-sm', // Button classes
                                                'data-toggle' => 'modal',
                                                'data-target' => '#staticBackdrop' . $payment->id,
                                                'style' => 'background-color: #d948b7;'
                                            ]
                                        ) ?>
                                    </div>
                                    <div class="mt-2">
                                        <?= $this->Form->postLink('Delete History', ['controller' => 'Payments', 'action' => 'delete', $payment->id], ['confirm' => 'Are you sure you want to delete?', 'class' => 'btn btn-danger btn-sm']) ?>
                                    </div>
                                    <?= $this->Form->postLink('Cancel Order', ['controller' => 'Payments', 'action' => 'cancelOrder', $payment->id], ['confirm' => 'Are you sure you want to cancel this order?', 'class' => 'btn btn-danger btn-sm']) ?>
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

<?php foreach ($payments as $payment): ?>
<div class="modal fade" id="myModal<?= $payment->id ?>">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header" style="align-items: center">
                <div class="title-box">
                    <h4 class="modal-title">Delivery Status<br>Order ID: <?= $payment->order_delivery ? h($payment->order_delivery->id) : 'N/A' ?></h4>
                </div>
                <div class="close-box">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="progress-track">
                    <ul id="progressbar">
                        <?php
                        $statusSteps = [
                            'DEL-00001' => 'Order placed',
                            'DEL-00002' => 'In Transit',
                            'DEL-00003' => 'Out for Delivery',
                            'DEL-00004' => 'Delivered'
                        ];

                        $currentStatus = $payment->order_delivery->deliverystatus_id ?? 'DEL-00001';
                        $statusCount = count($statusSteps);
                        $statusIndex = array_search($currentStatus, array_keys($statusSteps)) + 1; // Get the index of the current status

                        foreach ($statusSteps as $id => $status) {
                            $activeClass = $id === $currentStatus ? 'active' : '';
                            echo "<li class='$activeClass' style='position: relative;'>";
                            echo "<span>$status</span>";
                            if ($id === $currentStatus) {
                                echo "<div style='position: absolute; top: -10px; left: 50%; transform: translateX(-50%); width: 20px; height: 20px; background-color: white; border-radius: 50%;'></div>";
                            }
                            echo "</li>";
                        }
                        ?>
                    </ul>
                </div>
                <div class="details">
                    <p style="color: white"><strong>Delivery Date: <?= $payment->order_delivery ? h($payment->order_delivery->delivery_date->format('F d, Y')) : 'N/A' ?></strong></p>
                    <p style="color: white"><strong>Estimated Arrival: <?php if ($payment->order_delivery) {
                            // Create a DateTime object from the delivery date
                            $deliveryDate = new DateTime($payment->order_delivery->delivery_date->format('Y-m-d'));

                            // Add 5 days to the delivery date
                            $deliveryDate->add(new DateInterval('P5D'));  // 'P5D' means a period of 5 days

                            // Format the new date to display
                            echo $deliveryDate->format('F d, Y');
                        } else {
                            echo 'N/A';
                        }?></p>

                </div>
            </div>
        </div>
    </div>
</div>


    <div class="modal fade" id="staticBackdrop<?= $payment->id ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body ">

                    <div class="px-4 py-5">
                        <!-- Modal Header -->
                        <div class="modal-header" style="align-items: center">
                            <div class="title-box">
                                <h4 class="modal-title">Invoice<br>Order ID: <?= $payment->order_delivery ? h($payment->order_delivery->id) : 'N/A' ?></h4>
                            </div>
                            <div class="close-box">
                                <button type="button" class="close" style="margin: -7rem -4rem -2rem auto" data-dismiss="modal">&times;</button>
                            </div>
                        </div>

                        <h5 class="text-uppercase">Your Order Summary</h5>
                        <div class="mb-3">
                            <hr class="new1" style="border-width: thick">
                        </div>

                        <div class="d-flex justify-content-between">
                            <span class="font-weight-bold">Flower Name: </span>
                        </div>

                        <?php if ($payment->order_delivery && $payment->order_delivery->order_flowers): ?>
                            <?php foreach ($payment->order_delivery->order_flowers as $orderFlower): ?>
                                <?php $subTotal = $orderFlower->quantity * $orderFlower->flower->flower_price; ?>
                                <div class="d-flex justify-content-between">
                                    <span class="font-weight-bold"><?= h($orderFlower->quantity) ?> x <?= h($orderFlower->flower->flower_name) ?></span>
                                    <span class="text-muted">$<?= h($subTotal) ?></span>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>

                        <div class="mb-3">
                            <hr class="new1" style="color: whitesmoke !important; border-width: thick">
                        </div>
                        <div class="d-flex justify-content-between mt-3">
                            <span class="font-weight-bold" style="font-size: 20px">Total Amount Paid</span>
                            <span class="font-weight-bold theme-color" style="font-size: 35px">$<?= $payment->order_delivery ? h($payment->order_delivery->total_amount) : '0.00' ?></span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

<?php endforeach; ?>


