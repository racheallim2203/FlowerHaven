<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PaymentStatus $paymentStatus
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $paymentStatus->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $paymentStatus->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Payment Statuses'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="paymentStatuses form content">
            <?= $this->Form->create($paymentStatus) ?>
            <fieldset>
                <legend><?= __('Edit Payment Status') ?></legend>
                <?php
                    echo $this->Form->control('status_type');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
