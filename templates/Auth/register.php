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
            <?= $this->Form->control('phone_no', [
                'pattern' => '^\+[0-9]{1,3}\.[0-9]{1,14}$',
                'title' => 'Please enter a valid phone number (e.g., +123.45678901234567)',
                'required' => true
            ]); ?>
            <?php
            echo $this->Form->control('password', [
                'type' => 'password',
                'required' => true,
                'pattern' => '(?=.*[A-Za-z])(?=.*\d).{8,}',
                'title' => 'Password must contain at least one letter and one number, and be at least 8 characters long.'
            ]);
            echo $this->Form->control('password_confirm', [
                'type' => 'password',
                'value' => '',  // Ensure password is not sending back to the client side
                'label' => 'Retype Password'
            ]);
            ?>
        </fieldset>

        <?= $this->Form->button('Register') ?>
        <?= $this->Html->link('Back to login', ['controller' => 'Auth', 'action' => 'login'], ['class' => 'button button-outline float-right']) ?>
        <?= $this->Form->end() ?>

    </div>
</div>
