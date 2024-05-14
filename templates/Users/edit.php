<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
$this->layout = 'default';
$this->assign('title', 'Admin | Edit User');
?>
<div class="container-fluid">
    <div class="row">
        <aside class="col-md-4">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0"><?= __('Actions') ?></h4>
                </div>
                <div class="card-body">
                    <!-- Check if the current user is an admin and is the currently logged in user -->
                    <?php if (!$user->isAdmin && $user->id != $this->request->getSession()->read('Auth.User.id')): ?>
                        <!-- If not, a delete button is available to be pressed -->
                        <?= $this->Form->postLink(
                            __('Delete user'),
                            ['action' => 'delete', $user->id],
                            ['confirm' => __('Are you sure you want to delete this user?'), 'class' => 'btn btn-outline-danger btn-block']
                        ) ?>
                    <?php endif; ?>
                    <?= $this->Html->link(__('List users'), ['action' => 'index'], ['class' => 'btn btn-outline-info btn-block']) ?>
                </div>
            </div>
        </aside>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0"><?= __('Edit User') ?></h4>
                </div>
                <div class="card-body">
                    <!-- Edit user form -->
                    <?= $this->Form->create($user, ['class' => 'form', 'type' => 'file']) ?>
                    <fieldset>
                        <legend><?= __('User Information') ?></legend>
                        <?= $this->Form->control('username', [
                            'type' => 'text', 
                            'class' => 'form-control form-control-lg',
                            'placeholder' => 'Username'
                            ]); ?>

                        <?= $this->Form->control('email', [
                            'type' => 'email', 
                            'class' => 'form-control form-control-lg',
                            'placeholder' => 'email@example.com'
                            ]); ?>

                        <div class="form-group">
                            <label><?= __('Password') ?></label>
                            <input type="password" class="form-control" value="<?= h($user->password) ?>" readonly>
                        </div>  

                        <?= $this->Form->control('address', [
                            'type' => 'text', 
                            'class' => 'form-control form-control-lg',
                            'placeholder' => '123 Street, Suburb, Postcode'
                            ]); ?>

                        <?= $this->Form->control('phone_no', [
                            'type' => 'text', 
                            'class' => 'form-control form-control-lg',
                            'placeholder' => '+123.4567890123'
                            ]); ?>
                            
                        <div class="form-group">
                            <label><?= __('Is Admin') ?></label>
                            <?= $this->Form->control('isAdmin', [
                                'type' => 'select',
                                'options' => [0 => __('No'), 1 => __('Yes')],
                                'empty' => false,
                                'class' => 'form-control',
                                'label' => false
                            ]); ?>
                        </div>
                        <?= $this->Form->control('nonce', ['type' => 'hidden']); ?>
                        <?= $this->Form->control('nonce_expiry', ['type' => 'hidden']); ?>
                        
                        <div class="form-group">
                            <label><?= __('Is Archived') ?></label>
                            <?= $this->Form->control('isArchived', [
                                'type' => 'select',
                                'options' => [0 => __('No'), 1 => __('Yes')],
                                'empty' => false,
                                'class' => 'form-control',
                                'label' => false
                            ]); ?>
                        </div>
                    </fieldset>
                    <!-- Update button that submits the form with the updated user information -->
                    <div class="form-group mt-4">
                        <?= $this->Form->button(__('Update user'), ['class' => 'btn btn-lg btn-success']) ?>
                    </div>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>
