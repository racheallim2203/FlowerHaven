<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\User> $users
 */
$this->layout = 'default';
$this->assign('title', 'Admin | Users');
?>

<div class="container-fluid">

    <div class="row tm-content-row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
            <br>
            <div class="bg-white tm-block h-100">
                <div class="table-responsive">
                    <h2 class="text-center" style="font-weight: bold;">Users</h2>
                    <br>
                    <!-- Create a table showcasing the list of users in the database -->
                    <table class="table table-bordered" style="background-color: #f8f9fa;">
                        <thead>
                        <!-- User table's column names -->
                        <tr class="table-pink">
                            <th style="color: #9e297e;">ID</th>
                            <th style="color: #9e297e;">Username</th>
                            <th style="color: #9e297e;">Email</th>
                            <th style="color: #9e297e;">Address</th>
                            <th style="color: #9e297e;">Phone Number</th>
                            <th style="color: #9e297e;">Admin?</th>
                            <th style="color: #9e297e;">Archived?</th>
                            <th class="actions" style="color: #9e297e;"><?= __('Actions') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <!-- User information for each column -->
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?= h($user->id) ?></td>
                                <td><?= h($user->username) ?></td>
                                <td><?= h($user->email) ?></td>
                                <td><?= h($user->address) ?></td>
                                <td><?= h($user->phone_no) ?></td>
                                <td><?= $this->Number->format($user->isAdmin) ?></td>
                                <td><?= h($user->isArchived) ?></td>
                                <td class="actions">
                                    <div class="d-block mb-2">
                                        <?= $this->Html->link(__('View'), ['action' => 'view', $user->id], ['class' => 'btn btn-info btn-sm']) ?>
                                    </div>
                                    <div class="d-block mb-2">
                                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                    </div>
                                    <div class="d-block">
                                        <!-- Check if the current user is already archived -->
                                        <?php if (!$user->isArchived): ?>
                                            <!-- If not, an archive button is available to be pressed -->
                                            <?= $this->Form->postLink(
                                                __('Archive'),
                                                ['action' => 'archive', $user->id],
                                                ['confirm' => __('Are you sure you want to archive # {0}?', $user->id), 'class' => 'btn btn-danger btn-sm']
                                            ) ?>
                                        <?php else: ?>
                                            <!-- If yes, an un-archive button is available to be pressed -->
                                            <?= $this->Form->postLink(
                                                __('Unarchive'),
                                                ['action' => 'unarchive', $user->id],
                                                ['confirm' => __('Are you sure you want to unarchive # {0}?', $user->id), 'class' => 'btn btn-danger btn-sm']
                                            ) ?>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!--  -->
                <div class="paginator">
                    <ul class="pagination justify-content-center">
                        <?= $this->Paginator->first('<< ' . __('First')) ?>
                        <?= $this->Paginator->prev('< ' . __('Previous')) ?>
                        <?= $this->Paginator->numbers() ?>
                        <?= $this->Paginator->next(__('Next') . ' >') ?>
                        <?= $this->Paginator->last(__('Last') . ' >>') ?>
                    </ul>
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center mb-3">
                            <?= $this->Html->link('Add New User', ['action' => 'add'], ['class' => 'btn btn-success']) ?>
                        </div>
                    </div>
                    <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
                </div>
            </div>
        </div>
    </div>
</div>