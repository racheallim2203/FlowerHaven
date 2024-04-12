<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrderDelivery $orderDelivery
 * @var \Cake\Collection\CollectionInterface|string[] $orderStatus
 * @var \Cake\Collection\CollectionInterface|string[] $deliveryStatus
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Order Delivery'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="orderDelivery form content">
            <?= $this->Form->create($orderDelivery) ?>
            <fieldset>
                <legend><?= __('Add Order Delivery') ?></legend>
                <?php
                    echo $this->Form->control('orderstatus_id', ['options' => $orderStatus]);
                    echo $this->Form->control('deliverystatus_id', ['options' => $deliveryStatus]);
                    echo $this->Form->control('order_date');
                    echo $this->Form->control('total_amount');
                    echo $this->Form->control('delivery_date');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
