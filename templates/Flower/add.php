<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Flower $flower
 * @var \Cake\Collection\CollectionInterface|string[] $category
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Flower'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="flower form content">
            <?= $this->Form->create($flower) ?>
            <fieldset>
                <legend><?= __('Add Flower') ?></legend>
                <?php
                    echo $this->Form->control('flower_name');
                    echo $this->Form->control('flower_description');
                    echo $this->Form->control('flower_price');
                    echo $this->Form->control('stock_quantity');
                    echo $this->Form->control('category_id', ['options' => $category]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
