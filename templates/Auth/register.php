<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */

$this->layout = 'login';
$this->assign('title', 'Register new user');
?>
<div class="container register">
    <div class="row">
        <div class="column column-50 column-offset-25">
            <div class="users form content">
                <?= $this->Form->create($user) ?>
                <fieldset>
                    <legend>Sign Up</legend>
                    <?= $this->Flash->render() ?>

                    <div class="row">
                        <div class="column">
                            <?= $this->Form->control('email', [
                                'type' => 'email',
                                'label' => 'Email',
                                'placeholder' => 'email@example.com',
                                'class' => 'form-control'
                            ]); ?>
                        </div>
                        <div class="column">
                            <?= $this->Form->control('username', [
                                'type' => 'text',
                                'label' => 'Username',
                                'placeholder' => 'Your username',
                                'class' => 'form-control'
                            ]); ?>
                        </div>
                    </div>
                    <?= $this->Form->control('address', [
                        'type' => 'text',
                        'label' => 'Address',
                        'placeholder' => '123 Street, Suburb, Postcode',
                        'class' => 'form-control'
                    ]); ?>
                    <div class="row">
                        <div class="column">
                            <?= $this->Form->control('phone_no', [
                                'type' => 'text',
                                'label' => 'Phone Number',
                                'placeholder' => '+123.4567890123',
                                'class' => 'form-control'
                            ]); ?>
                        </div>
                        <div class="column">
                        </div>
                    </div>
                    <div class="row">
                            <div class="column">
                                <?= $this->Form->control('password', [
                                    'type' => 'password',
                                    'required' => true,
                                    'label' => 'Password',
                                    'placeholder' => 'Password',
                                    'class' => 'form-control'
                                ]); ?>
                            </div>
                            <div class="column">
                                <?= $this->Form->control('password_confirm', [
                                    'type' => 'password',
                                    'required' => true,
                                    'label' => 'Confirm Password',
                                    'placeholder' => 'Confirm Password',
                                    'class' => 'form-control'
                                ]); ?>
                            </div>
                        </div>
                </fieldset>
            <div class="row">
                <div class="column">
                    <?= $this->Form->button('Register', ['class' => 'btn btn-primary']) ?>
                </div>
                <div class="column">
                    <?= $this->Html->link('Back to login', ['controller' => 'Auth', 'action' => 'login'], ['class' => 'btn btn-outline-primary']) ?>
                    <?= $this->Form->end() ?>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
