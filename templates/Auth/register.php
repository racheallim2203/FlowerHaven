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

            <?= $this->Form->control('email', ['type' => 'email', 'required' => true]); ?>

            <?= $this->Form->control('username'); ?>

            <?= $this->Form->control('address'); ?>

            <div class="row">
                <?= $this->Form->control('phone_no', ['pattern' => '^\+[0-9]{1,3}\.[0-9]{1,14}$', 'templateVars' => ['container_class' => 'column'],'title' => 'Please enter a valid phone number (e.g., +123.45678901234567)', 'required' => true]); ?>
                <?= $this->Form->control('isAdmin', ['templateVars' => ['container_class' => 'column']]); ?>
            </div>

            <div class="row">
                <?= $this->Form->control('nonce', ['pattern' => '^[0-9]+$', 'title' => 'Nonce must contain only numbers.', 'templateVars' => ['container_class' => 'column'],'required' => true]); ?>
                <?= $this->Form->control('nonce_expiry', ['templateVars' => ['container_class' => 'column']]); ?>
            </div>

            <div class="row">
                <?php
                echo $this->Form->control('password', [
                    'type' => 'password',
                    'required' => true,
                    'pattern' => '(?=.*[A-Za-z])(?=.*\d).{8,}',
                    'title' => 'Password must contain at least one letter and one number, and be at least 8 characters long.',
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
