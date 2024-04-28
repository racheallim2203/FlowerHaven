<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Datasource\ConnectionManager;
use DateTime;
use Exception;
use Cake\ORM\TableRegistry;
use Cake\Log\Log;
use Cake\Mailer\Mailer;


/**
 *
 * @property \App\Model\Table\OrderDeliveriesTable $OrderDeliveries
 *  @property \App\Model\Table\PaymentsTable $Payments
 *  *  @property \App\Model\Table\UsersTable $Users
 * @property \App\Model\Table\FlowersTable $Flowers
 *  @property \App\Model\Table\PaymentMethodsTable $PaymentMethods
 *  *  @property \App\Model\Entity\Payment $Payment
 */
?>

<h1>Order Receipt</h1>
<p>Dear Customer,</p>
<p>Thank you for your purchase. Here are the details of your order:</p>
<ul>
    <?php foreach ($order['items'] as $item): ?>
        <li><?= h($item['name']) ?>: $<?= h($item['price']) ?></li>
    <?php endforeach; ?>
</ul>
<p>Total: $<?= h($order['totalAmount']) ?></p>
<p>Order ID: <?= h($order['id']) ?></p>
