<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrderFlower $orderFlower
 * @var \Cake\Collection\CollectionInterface|string[] $flower
 * @var \Cake\Collection\CollectionInterface|string[] $orderDelivery
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
        <div class="orderFlower form content">
            <?= $this->Form->create($orderFlower) ?>
            <fieldset>
                <legend><?= __('Add Order Flowers') ?></legend>
                <?php
                    echo $this->Form->control('flower_id', ['options' => $flower]);
                    echo $this->Form->control('orderdelivery_id', ['options' => $orderDelivery]);
                    echo $this->Form->control('quantity');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
