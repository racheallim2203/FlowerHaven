<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Payment $payment
 * @var \Cake\Collection\CollectionInterface|string[] $orderDelivery
 * @var \Cake\Collection\CollectionInterface|string[] $paymentStatus
 * @var \Cake\Collection\CollectionInterface|string[] $paymentMethod
 * @var \Cake\Collection\CollectionInterface|string[] $user
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Payment'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="payment form content">
            <?= $this->Form->create($payment) ?>
            <fieldset>
                <legend><?= __('Add Payment') ?></legend>
                <?php
                    echo $this->Form->control('orderdelivery_id', ['options' => $orderDelivery]);
                    echo $this->Form->control('paymentstatus_id', ['options' => $paymentStatus]);
                    echo $this->Form->control('paymentmethod_id', ['options' => $paymentMethod]);
                    echo $this->Form->control('user_id', ['options' => $user]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
