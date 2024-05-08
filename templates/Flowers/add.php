<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Flower $flower
 * @var \Cake\Collection\CollectionInterface|string[] $categories
 */
$this->layout = 'default';
$this->assign('title', 'Admin | Add New Flower');
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
                        <?= $this->Form->control('flower_name', [
                            'class' => 'form-control form-control-lg',
                            'required' => true, // Ensures the field is required
                            'placeholder' => 'Enter flower name:'
                        ]); ?>
                        <div class="form-group">
                            <?= $this->Form->control('flower_description', [
                                'class' => 'form-control form-control-lg',
                                'placeholder' => 'Flower description:'
                            ]); ?>
                        </div>
                        <div class="form-group">
                            <?= $this->Form->control('flower_price', [
                                'class' => 'form-control form-control-lg',
                                'type' => 'number', // Specifies that the input must be a number
                                'step' => '0.01', // Allows decimal values
                                'required' => true,
                                'min' => '0.5', // Minimum value
                                'placeholder' => 'Price:'
                            ]); ?>
                        </div>
                        <div class="form-group">
                            <?= $this->Form->control('stock_quantity', [
                                'class' => 'form-control form-control-lg',
                                'type' => 'number', // Ensures the input must be a number
                                'required' => true,
                                'placeholder' => 'Stock quantity:'
                            ]); ?>
                        </div>
                        <div class="form-group">
                            <?= $this->Form->control('image_file', ['type' => 'file', 'accept' => 'image/png,image/gif,image/jpeg']); ?>
                        </div>
                        <div class="form-group">
                            <?= $this->Form->control('category_id', [
                                'options' => $categories,
                                'class' => 'form-control form-control-lg',
                                'label' => 'Category',
                                'empty' => 'Select a category:',
                                'required' => true
                            ]); ?>
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
