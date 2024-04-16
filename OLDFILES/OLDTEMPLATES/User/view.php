<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List User'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New User'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="user view content">
            <h3><?= h($user->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= h($user->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Nonce') ?></th>
                    <td><?= h($user->nonce) ?></td>
                </tr>
                <tr>
                    <th><?= __('Non Expiry') ?></th>
                    <td><?= h($user->non_expiry) ?></td>
                </tr>
                <tr>
                    <th><?= __('IsAdmin') ?></th>
                    <td><?= $user->isAdmin ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Username') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($user->username)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Email') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($user->email)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Address') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($user->address)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Phone No') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($user->phone_no)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Payment') ?></h4>
                <?php if (!empty($user->payment)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Orderdelivery Id') ?></th>
                            <th><?= __('Paymentstatus Id') ?></th>
                            <th><?= __('Paymentmethod Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->payment as $payment) : ?>
                        <tr>
                            <td><?= h($payment->id) ?></td>
                            <td><?= h($payment->orderdelivery_id) ?></td>
                            <td><?= h($payment->paymentstatus_id) ?></td>
                            <td><?= h($payment->paymentmethod_id) ?></td>
                            <td><?= h($payment->user_id) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Payment', 'action' => 'view', $payment->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Payment', 'action' => 'edit', $payment->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Payment', 'action' => 'delete', $payment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $payment->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
