<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrderFlower $orderFlower
 * @var \Cake\Collection\CollectionInterface|string[] $flowers
 * @var \Cake\Collection\CollectionInterface|string[] $orderDeliveries
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Order Flowers'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="orderFlowers form content">
            <?= $this->Form->create($orderFlower) ?>
            <fieldset>
                <legend><?= __('Add Order Flowers') ?></legend>
                <?php
                    echo $this->Form->control('flower_id', ['options' => $flowers]);
                    echo $this->Form->control('orderdelivery_id', ['options' => $orderDeliveries]);
                    echo $this->Form->control('quantity');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
