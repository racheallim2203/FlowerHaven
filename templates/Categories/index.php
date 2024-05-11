<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Category> $categoriesList
 * @var iterable<\App\Model\Entity\Flower> $flowers
 */
?>
<div class="container-fluid">
    <div class="row">
        <?= $this->Form->create(null, ['type' => 'get', 'class' => 'form-inline']) ?>
        <div class="col-md-4 mb-3">
            <?= $this->Form->control('search', [
                'label' => false,
                'class' => 'form-control',
                'placeholder' => 'Search Flowers',
                'value' => $this->request->getQuery('search'),
                'maxlength' => '15' // Set your desired word limit here
            ]) ?>
        </div>
        <div class="col-md-4 mb-3">
            <?= $this->Form->control('category', [
                'type' => 'select',
                'label' => false,
                'class' => 'form-control',
                'options' => $categoriesList,
                'empty' => 'Select Categories',
                'value' => $this->request->getQuery('category')
            ]) ?>
        </div>
        <div class="col-md-2 mb-3 d-flex">
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
                    <h2 class="text-center" style="font-weight: bold;">Category List</h2>
                    <br>
                    <table class="table table-bordered" style="background-color: #f8f9fa;">
                        <thead>
                        <tr class="table-pink">
                            <th><?= $this->Paginator->sort('id') ?></th>
                            <th><?= $this->Paginator->sort('category_name') ?></th>
                            <th><?= $this->Paginator->sort('category_description') ?></th>
                            <th><?= $this->Paginator->sort('flower_name') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($categories as $category): ?>
                            <tr>
                                <td><?= h($category->id) ?></td>
                                <td><?= h($category->category_name) ?></td>
                                <td><?= h($category->category_description) ?></td>
                                <td>
                                    <?php
                                    // Displaying flower names linked to the category
                                    $flowerNames = [];
                                    if (!empty($category->flowers)) {
                                        foreach ($category->flowers as $flowers) {
                                            $flowerNames[] = h($flowers->flower_name);
                                        }
                                    }
                                    echo implode(', ', $flowerNames); // Join names by comma
                                    ?>
                                </td>
                                <td class="actions">
                                    <div class="d-block mb-2">
                                        <?= $this->Html->link(__('View'), ['action' => 'view', $category->id], ['class' => 'btn btn-info btn-sm']) ?>
                                    </div>
                                    <div class="d-block mb-2">
                                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $category->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                    </div>
                                    <div class="d-block">
                                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $category->id], ['confirm' => __('Are you sure you want to delete # {0}?', $category->id), 'class' => 'btn btn-danger btn-sm']) ?>
                                    </div>
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
                            <?= $this->Html->link('Add New Categories', ['action' => 'add'], ['class' => 'btn btn-success']) ?>
                        </div>
                    </div>

                    <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
