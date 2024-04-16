<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DeliveryStatus $deliveryStatus
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Delivery Status'), ['action' => 'edit', $deliveryStatus->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Delivery Status'), ['action' => 'delete', $deliveryStatus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $deliveryStatus->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Delivery Status'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Delivery Status'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="deliveryStatus view content">
            <h3><?= h($deliveryStatus->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= h($deliveryStatus->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Delivery Status') ?></th>
                    <td><?= h($deliveryStatus->delivery_status) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
