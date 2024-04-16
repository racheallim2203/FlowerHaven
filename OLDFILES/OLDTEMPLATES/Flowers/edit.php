<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Flower $flower
 * @var string[]|\Cake\Collection\CollectionInterface $categories
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $flower->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $flower->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Flowers'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="flowers form content">
            <?= $this->Form->create($flower) ?>
            <fieldset>
                <legend><?= __('Edit Flowers') ?></legend>
                <?php
                    echo $this->Form->control('flower_name');
                    echo $this->Form->control('flower_description');
                    echo $this->Form->control('flower_price');
                    echo $this->Form->control('stock_quantity');
                    echo $this->Form->control('category_id', ['options' => $categories]);
                    echo $this->Form->control('image');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
