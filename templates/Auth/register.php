<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */

$this->layout = 'login';
$this->assign('title', 'Register new user');
?>
<div class="container register">
    <div class="users form content">

        <?= $this->Form->create($user) ?>

        <fieldset>
            <legend>Register new user</legend>

            <?= $this->Flash->render() ?>

            <?= $this->Form->control('email'); ?>

            <?= $this->Form->control('username'); ?>

            <?= $this->Form->control('address'); ?>

            <div class="row">
                <?= $this->Form->control('phone_no', ['templateVars' => ['container_class' => 'column']]); ?>
                <?= $this->Form->control('isAdmin', ['templateVars' => ['container_class' => 'column']]); ?>
            </div>

            <div class="row">
                <?= $this->Form->control('nonce', ['templateVars' => ['container_class' => 'column']]); ?>
                <?= $this->Form->control('nonce_expiry', ['templateVars' => ['container_class' => 'column']]); ?>
            </div>

            <div class="row">
                <?php
                echo $this->Form->control('password', [
                        'type' => 'password',
                        'value' => '',  // Ensure password is not sending back to the client side
                        'templateVars' => ['container_class' => 'column']
                ]);
                // Validate password by repeating it
                echo $this->Form->control('password_confirm', [
                    'type' => 'password',
                    'value' => '',  // Ensure password is not sending back to the client side
                    'label' => 'Retype Password',
                    'templateVars' => ['container_class' => 'column']
                ]);
                ?>
            </div>

        </fieldset>

        <?= $this->Form->button('Register') ?>
        <?= $this->Html->link('Back to login', ['controller' => 'Auth', 'action' => 'login'], ['class' => 'button button-outline float-right']) ?>
        <?= $this->Form->end() ?>

    </div>
</div>
