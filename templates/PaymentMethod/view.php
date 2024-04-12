<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PaymentMethod $paymentMethod
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Payment Method'), ['action' => 'edit', $paymentMethod->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Payment Method'), ['action' => 'delete', $paymentMethod->id], ['confirm' => __('Are you sure you want to delete # {0}?', $paymentMethod->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Payment Method'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Payment Method'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="paymentMethod view content">
            <h3><?= h($paymentMethod->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= h($paymentMethod->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Method Type') ?></th>
                    <td><?= h($paymentMethod->method_type) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
