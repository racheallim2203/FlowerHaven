<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrderStatus $orderStatus
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Order Status'), ['action' => 'edit', $orderStatus->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Order Status'), ['action' => 'delete', $orderStatus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $orderStatus->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Order Statuses'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Order Status'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="orderStatuses view content">
            <h3><?= h($orderStatus->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= h($orderStatus->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Order Type') ?></th>
                    <td><?= h($orderStatus->order_type) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
