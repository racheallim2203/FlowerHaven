<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<br>
<div class="container-fluid">
    <div class="row">
        <aside class="col-xl-3 col-lg-3 col-md-4 col-sm-12">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0"><?= __('Actions') ?></h4>
                </div>
                <div class="card-body">
                    <?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id], ['class' => 'btn btn-primary btn-block']) ?>
                    <?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index'], ['class' => 'btn btn-info btn-block']) ?>
                    <?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add'], ['class' => 'btn btn-success btn-block']) ?>
                </div>
            </div>
        </aside>
        <div class="col-xl-9 col-lg-9 col-md-8 col-sm-12">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0"><?= __('User Details') ?></h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tbody>
                        <tr>
                            <th><?= __('ID') ?></th>
                            <td><?= h($user->id) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Username') ?></th>
                            <td><?= h($user->username) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Email') ?></th>
                            <td><?= h($user->email) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Address') ?></th>
                            <td>
                                <?= h($user->address) ?: __('Not Available') ?>
                            </td>
                        </tr>
                        <tr>
                            <th><?= __('Phone Number') ?></th>
                            <td>
                                <?= h($user->phone_no) ?: __('Not Available') ?>
                            </td>
                        </tr>
                        <?php if ($user->isAdmin): ?>
                            <tr>
                                <th><?= __('Admin') ?></th>
                                <td><?= $user->isAdmin ? __('Yes') : __('No') ?></td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

