<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="container-fluid">
    <div class="row">
        <aside class="col-md-4">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0"><?= __('Actions') ?></h4>
                </div>
                <div class="card-body">
                    <?= $this->Form->postLink(
                        __('Delete User'),
                        ['action' => 'delete', $user->id],
                        ['confirm' => __('Are you sure you want to delete this user?'), 'class' => 'btn btn-outline-danger btn-block']
                    ) ?>
                    <?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'btn btn-outline-info btn-block']) ?>
                </div>
            </div>
        </aside>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0"><?= __('Edit User') ?></h4>
                </div>
                <div class="card-body">
                    <?= $this->Form->create($user) ?>
                    <fieldset>
                        <legend><?= __('User Information') ?></legend>
                        <?= $this->Form->control('username', ['class' => 'form-control form-control-lg']); ?>
                        <?= $this->Form->control('email', ['class' => 'form-control form-control-lg']); ?>
                        <?= $this->Form->control('password', ['class' => 'form-control form-control-lg']); ?>
                        <?= $this->Form->control('address', ['class' => 'form-control form-control-lg']); ?>
                        <?= $this->Form->control('phone_no', ['class' => 'form-control form-control-lg']); ?>
                        <div class="form-group">
                            <label><?= __('Is Admin') ?></label>
                            <input type="text" class="form-control" value="<?= $user->isAdmin ? __('Yes') : __('No'); ?>" readonly>
                        </div>
                        <?= $this->Form->control('nonce', ['type' => 'hidden']); ?>
                        <?= $this->Form->control('nonce_expiry', ['type' => 'hidden']); ?>
                    </fieldset>
                    <div class="form-group mt-4">
                        <?= $this->Form->button(__('Update User'), ['class' => 'btn btn-lg btn-success']) ?>
                    </div>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>
