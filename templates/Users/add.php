<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
$this->layout = 'default';
$this->assign('title', 'Admin | Register New User');
?>
?>
<div class="container-fluid">
    <div class="row">
        <aside class="col-xl-3 col-lg-3 col-md-4 col-sm-12">
            <div class="card card-body">
                <div class="card-header" style="color: white; background-color: #ccaf47;">
                    <h4 class="tm-block-title font-weight-bold"><?= __('Actions') ?></h4>
                </div>
                <!-- Button to view the list of users in the database -->
                <div class="card-body">
                    <?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'btn btn-outline-info btn-block']) ?>
                </div>
            </div>
        </aside>
        <div class="col-xl-9 col-lg-9 col-md-8 col-sm-12">
            <div class="card">
                <div class="card card-body text-white" style="background-color: #69064e;">
                    <h4 class="mb-0"><?= __('Add User') ?></h4>
                </div>
                <!-- Form to create a new user -->
                <div class="card-body">
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

                        <?= $this->Form->control('password', [
                            'type' => 'password',
                            'required' => true,
                            'label' => 'Password',
                            'placeholder' => 'Password',
                            'class' => 'form-control form-control-lg'
                        ]); ?>

                        <?= $this->Form->control('password_confirm', [
                            'type' => 'password',
                            'required' => true,
                            'label' => 'Confirm Password',
                            'placeholder' => 'Confirm Password',
                            'class' => 'form-control form-control-lg'
                        ]); ?>

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
                        
                        <!-- Form button that submits and adds the inputted information into the database -->
                        <div class="form-group mt-4">
                            <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-lg btn-success']) ?>
                        </div>
                        <?= $this->Form->end() ?>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</div>





