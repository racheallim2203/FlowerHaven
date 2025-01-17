<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Flower> $flowers
 *  * @var iterable<\App\Model\Entity\Category> $categories
 */

$this->assign('title', 'Admin | Flowers');
?>

<div class="container-fluid">
    <div class="row">
        <?= $this->Form->create(null, ['type' => 'get', 'class' => 'form-inline']) ?>
        <div class="col-md-3 mb-2">
            <?= $this->Form->control('search', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Search Flowers', 'value' => $this->request->getQuery('search'),'maxlength' => '15'])  ?>
        </div>
        <div class="col-md-3 mb-2">
            <?= $this->Form->control('category', [
                'type' => 'select',
                'label' => false,
                'class' => 'form-control',
                'options' => $categories,
                'empty' => 'Select Categories',
                'value' => $this->request->getQuery('category')
            ]) ?>
        </div>
        <div class="col-md-3 mb-2">
            <?= $this->Form->control('archive', [
                'type' => 'select',
                'label' => false,
                'class' => 'form-control',
                'options' => ['0' => 'Not Archived', '1' => 'Archived'],
                'empty' => 'Archive Status',
                'value' => $this->request->getQuery('archive')
            ]) ?>
        </div>
        <div class="col-md-3 mb-3 d-flex">
            <?= $this->Form->button(__('Search'), ['class' => 'btn btn-primary']) ?>
            <?= $this->Html->link('Refresh', ['action' => 'index'], ['class' => 'btn btn-secondary ml-2']) ?>
        </div>
        <?= $this->Form->end() ?>
    </div>
    <div class="row tm-content-row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
            <br>
            <div class="bg-white tm-block h-100">
                <div class="table-responsive">
                    <h2 class="text-center" style="font-weight: bold;">Flower Inventory</h2>
                    <br>
                    <table class="table table-bordered" style="background-color: #f8f9fa;">
                        <thead>
                        <tr class="table-pink">
                            <th style="color: #9e297e;">ID</th>
                            <th style="color: #9e297e;">Flower Name</th>
                            <th style="color: #9e297e;">Flower Price</th>
                            <th style="color: #9e297e;">Stock Quantity</th>
                            <th style="color: #9e297e;">Category</th>
                            <th style="color: #9e297e;">Archived?</th>
                            <th class="actions" style="color: #9e297e;"><?= __('Actions') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($flowers as $flower): ?>
                            <tr>
                                <td><?= h($flower->id) ?></td>
                                <td><?= h($flower->flower_name) ?></td>
                                <td><?= $this->Number->currency($flower->flower_price) ?></td>
                                <td><?= $this->Number->format($flower->stock_quantity) ?></td>
                                <td>
                                    <?= $flower->has('category') && !empty($flower->category->category_name) ? $this->Html->link($flower->category->category_name, ['controller' => 'Categories', 'action' => 'view', $flower->category->id]) : __('No Categories') ?>
                                </td>
                                <td><?= h($flower->isArchived ? __('Yes') : __('No') ) ?></td>
                                <td class="actions">
                                    <div class="d-block mb-2">
                                        <?= $this->Html->link(__('View'), ['action' => 'view', $flower->id], ['class' => 'btn btn-info btn-sm']) ?>
                                    </div>
                                    <div class="d-block mb-2">
                                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $flower->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                    </div>
                                    <!-- Check if the current user is already archived -->
                                    <?php if (!$flower->isArchived): ?>
                                        <!-- If not, an archive button is available to be pressed -->
                                        <?= $this->Form->postLink(
                                            __('Archive'),
                                            ['action' => 'archive', $flower->id],
                                            ['confirm' => __('Are you sure you want to archive # {0}?', $flower->id), 'class' => 'btn btn-danger btn-sm']
                                        ) ?>
                                    <?php else: ?>
                                        <!-- If yes, an un-archive button is available to be pressed -->
                                        <?= $this->Form->postLink(
                                            __('Unarchive'),
                                            ['action' => 'unarchive', $flower->id],
                                            ['confirm' => __('Are you sure you want to unarchive # {0}?', $flower->id), 'class' => 'btn btn-danger btn-sm']
                                        ) ?>
                                    <?php endif; ?>
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
                            <?= $this->Html->link('Add New Flowers', ['action' => 'add'], ['class' => 'btn btn-success']) ?>
                        </div>
                    </div>
                    <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
                </div>
            </div>
        </div>
    </div>

</div>
