<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Flower $flower
 * @var \Cake\Collection\CollectionInterface|string[] $categories
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
                    <?= $this->Html->link(__('List Flowers'), ['action' => 'index'], ['class' => 'btn btn-outline-info btn-block']) ?>
                </div>
            </div>
        </aside>
        <div class="col-xl-9 col-lg-9 col-md-8 col-sm-12">
            <div class="card">
                <div class="card card-body text-white" style="background-color: #69064e;">
                    <h4 class="mb-0"><?= __('Add Flowers') ?></h4>
                </div>
                <div class="card-body">
                    <?= $this->Form->create($flower, ['type' => 'file']) ?>
                    <fieldset>
                        <div class="form-group">
                            <?= $this->Form->control('flower_name', ['class' => 'form-control form-control-lg']); ?>
                        </div>
                        <div class="form-group">
                            <?= $this->Form->control('flower_description', ['class' => 'form-control form-control-lg']); ?>
                        </div>
                        <div class="form-group">
                            <?= $this->Form->control('flower_price', ['class' => 'form-control form-control-lg']); ?>
                        </div>
                        <div class="form-group">
                            <?= $this->Form->control('stock_quantity', ['class' => 'form-control form-control-lg']); ?>
                        </div>
                        <div class="form-group">
                            <?= $this->Form->control('image', ['type' => 'file']); ?>
                        </div>
                        <div class="form-group">
                            <?= $this->Form->control('category_id', ['options' => $categories, 'class' => 'form-control form-control-lg']); ?>
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
