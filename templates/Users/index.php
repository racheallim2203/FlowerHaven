<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\User> $users
 */
?>
<div class="container-fluid">
    <div class="row tm-content-row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
            <br>
            <div class="bg-white tm-block h-100">
                <div class="table-responsive">
                    <h2 class="text-center" style="font-weight: bold;">Users</h2>
                    <br>
                    <table class="table table-bordered" style="background-color: #f8f9fa;">
                        <thead>
                        <tr class="table-pink">
                            <th style="color: #9e297e;"><?= $this->Paginator->sort('id') ?></th>
                            <th style="color: #9e297e;"><?= $this->Paginator->sort('username') ?></th>
                            <th style="color: #9e297e;"><?= $this->Paginator->sort('email') ?></th>
                            <th style="color: #9e297e;"><?= $this->Paginator->sort('address') ?></th>
                            <th style="color: #9e297e;"><?= $this->Paginator->sort('phone_no') ?></th>
                            <th style="color: #9e297e;"><?= $this->Paginator->sort('isAdmin') ?></th>
                            <th style="color: #9e297e;"><?= $this->Paginator->sort('nonce') ?></th>
                            <th style="color: #9e297e;"><?= $this->Paginator->sort('nonce_expiry') ?></th>
                            <th class="actions" style="color: #9e297e;"><?= __('Actions') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?= h($user->id) ?></td>
                                <td><?= h($user->username) ?></td>
                                <td><?= h($user->email) ?></td>
                                <td><?= h($user->address) ?></td>
                                <td><?= h($user->phone_no) ?></td>
                                <td><?= h($user->isAdmin) ?></td>
                                <td><?= h($user->nonce) ?></td>
                                <td><?= h($user->nonce_expiry) ?></td>
                                <td class="actions">
                                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'btn btn-danger btn-sm']) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
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
