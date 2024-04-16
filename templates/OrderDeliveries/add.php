<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrderDelivery $orderDelivery
 * @var \Cake\Collection\CollectionInterface|string[] $orderstatuses
 * @var \Cake\Collection\CollectionInterface|string[] $deliveryStatuses
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Order Deliveries'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="orderDeliveries form content">
            <?= $this->Form->create($orderDelivery) ?>
            <fieldset>
                <legend><?= __('Add Order Delivery') ?></legend>
                <?php
                    echo $this->Form->control('orderstatus_id', ['options' => $orderstatuses]);
                    echo $this->Form->control('deliverystatus_id', ['options' => $deliveryStatuses]);
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
