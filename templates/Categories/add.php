<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category $category
 */
?>
<br>
<div class="container-fluid">
    <div class="row">
        <aside class="col-xl-3 col-lg-3 col-md-4 col-sm-12">
            <div class="card card-body">
                <div class="card-header" style="color: white; background-color: #ccaf47;">
                    <h4 class="tm-block-title font-weight-bold"><?= __('Actions') ?></h4>
                </div>
                <div class="card-body">
                    <?= $this->Html->link(__('List Categories'), ['action' => 'index'], ['class' => 'btn btn-outline-info btn-block']) ?>
                </div>
            </div>
        </aside>
        <div class="col-xl-9 col-lg-9 col-md-8 col-sm-12">
            <div class="card">
                <div class="card card-body text-white" style="background-color: #69064e;">
                    <h4 class="mb-0"><?= __('Add Category') ?></h4>
                </div>
                <div class="card-body">
                    <?= $this->Form->create($category, ['class' => 'form']) ?>
                    <fieldset>
                        <div class="form-group">
                            <?= $this->Form->control('category_name', ['class' => 'form-control form-control-lg', 'label' => 'Category Name']); ?>
                        </div>
                        <div class="form-group">
                            <?= $this->Form->control('description', ['class' => 'form-control form-control-lg', 'label' => 'Description', 'type' => 'textarea']); ?>
                        </div>
                    </fieldset>
                    <div class="form-group mt-4">
                        <?= $this->Form->button(__('Save'), ['class' => 'btn btn-lg btn-success']) ?>
                    </div>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>

