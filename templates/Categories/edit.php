<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category $category
 */
?>
<div class="container-fluid">
    <div class="row">
        <aside class="col-md-4">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0"><?= __('Actions') ?></h4>
                </div>
                <div class="card-body">
                    <?= $this->Html->link(__('List Categories'), ['action' => 'index'], ['class' => 'btn btn-outline-info btn-block']) ?>
                    <?= $this->Form->postLink(
                        __('Delete Categories'),
                        ['action' => 'delete', $category->id],
                        ['confirm' => __('Are you sure you want to delete # {0}?', $category->id), 'class' => 'btn btn-outline-danger btn-block']
                    ) ?>
                </div>
            </div>
        </aside>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0"><?= __('Edit Categories') ?></h4>
                </div>
                <div class="card-body">
                    <?= $this->Form->create($category) ?>
                    <fieldset>
                        <div class="form-group">
                            <?= $this->Form->control('category_name', ['class' => 'form-control form-control-lg']); ?>
                        </div>
                        <div class="form-group">
                            <?= $this->Form->control('category_description', ['class' => 'form-control form-control-lg', 'type' => 'textarea']); ?>
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
