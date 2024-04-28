<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="container-fluid">
    <div class="row">
        <aside class="col-xl-3 col-lg-3 col-md-4 col-sm-12">
            <div class="card card-body">
                <div class="card-header" style="color: white; background-color: #ccaf47;">
                    <h4 class="tm-block-title font-weight-bold"><?= __('Actions') ?></h4>
                </div>
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
                <div class="card-body">
                    <?= $this->Form->create($user, ['type' => 'file']) ?>
                    <fieldset>
                        <div class="form-group">
                            <?= $this->Form->control('username', ['class' => 'form-control form-control-lg']); ?>
                        </div>
                        <div class="form-group">
                            <?= $this->Form->control('email', ['class' => 'form-control form-control-lg']); ?>
                        </div>
                        <div class="form-group">
                            <?= $this->Form->control('password', ['class' => 'form-control form-control-lg']); ?>
                        </div>
                        <div class="form-group">
                            <?= $this->Form->control('phone_no', ['class' => 'form-control form-control-lg']); ?>
                        </div>
                        <div class="form-group">
                            <?= $this->Form->control('isAdmin', ['class' => 'form-control form-control-lg']); ?>
                        </div>

                    </fieldset>
                    <div class="form-group mt-4">
                        <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-lg btn-success']) ?>
                    </div>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>





