<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category $category
 * @var \App\Model\Entity\Flower $flowers
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
                    <?= $this->Html->link(__('Edit Categories'), ['action' => 'edit', $category->id], ['class' => 'btn btn-primary btn-block']) ?>
                    <?= $this->Form->postLink(
                        __('Delete Categories'),
                        ['action' => 'delete', $category->id],
                        ['confirm' => __('Are you sure you want to delete # {0}?', $category->id), 'class' => 'btn btn-danger btn-block']
                    ) ?>
                    <?= $this->Html->link(__('All Categories'), ['action' => 'index'], ['class' => 'btn btn-info btn-block']) ?>
                    <?= $this->Html->link(__('New Categories'), ['action' => 'add'], ['class' => 'btn btn-success btn-block']) ?>
                </div>
            </div>
        </aside>
        <div class="col-xl-9 col-lg-9 col-md-8 col-sm-12">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0"><?= __('Categories Details') ?></h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tbody>
                        <tr>
                            <th><?= __('ID') ?></th>
                            <td><?= h($category->id) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Categories Name') ?></th>
                            <td><?= h($category->category_name) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Description') ?></th>
                            <td><?= h($category->category_description) ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <br><br>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <h4 class="font-weight-bold"><?= __('Flowers in this Categories') ?></h4>
                </div>
                <div class="card-body">
                    <?php if (!empty($category->flowers)): ?>
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead style="background-color: #9e297e; color:white">
                                <tr>
                                    <th><?= __('Id') ?></th>
                                    <th><?= __('Flowers Name') ?></th>
                                    <th><?= __('Price') ?></th>
                                    <th class="actions"><?= __('Actions') ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($category->flowers as $flowers): ?>
                                    <tr>
                                        <td><?= h($flowers->id) ?></td>
                                        <td><?= h($flowers->flower_name) ?></td>
                                        <td><?= $this->Number->currency($flowers->flower_price) ?></td>
                                        <td class="actions">
                                            <?= $this->Html->link(__('View'), ['controller' => 'Flowers', 'action' => 'view', $flowers->id], ['class' => 'btn btn-info btn-sm']) ?>
                                            <?= $this->Html->link(__('Edit'), ['controller' => 'Flowers', 'action' => 'edit', $flowers->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p class="text-muted"><?= __('No flowers found in this category.') ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
