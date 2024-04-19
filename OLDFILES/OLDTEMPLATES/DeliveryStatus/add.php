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
            <?= $this->Html->link(__('List Delivery Status'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="deliveryStatus form content">
            <?= $this->Form->create($deliveryStatus) ?>
            <fieldset>
                <legend><?= __('Add Delivery Status') ?></legend>
                <?php
                    echo $this->Form->control('delivery_status');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>