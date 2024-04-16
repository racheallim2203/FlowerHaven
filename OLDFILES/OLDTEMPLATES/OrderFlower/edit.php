<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrderFlower $orderFlower
 * @var string[]|\Cake\Collection\CollectionInterface $flower
 * @var string[]|\Cake\Collection\CollectionInterface $orderDelivery
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $orderFlower->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $orderFlower->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Order Flowers'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="orderFlower form content">
            <?= $this->Form->create($orderFlower) ?>
            <fieldset>
                <legend><?= __('Edit Order Flowers') ?></legend>
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
