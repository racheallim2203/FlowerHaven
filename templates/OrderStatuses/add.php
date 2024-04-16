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
            <?= $this->Html->link(__('List Order Statuses'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="orderStatuses form content">
            <?= $this->Form->create($orderStatus) ?>
            <fieldset>
                <legend><?= __('Add Order Status') ?></legend>
                <?php
                    echo $this->Form->control('order_type');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
