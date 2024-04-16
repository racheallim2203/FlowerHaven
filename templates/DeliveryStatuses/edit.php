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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $deliveryStatus->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $deliveryStatus->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Delivery Statuses'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="deliveryStatuses form content">
            <?= $this->Form->create($deliveryStatus) ?>
            <fieldset>
                <legend><?= __('Edit Delivery Status') ?></legend>
                <?php
                    echo $this->Form->control('delivery_status');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
