<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CategoriesProduct $categoriesProduct
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Categories Product'), ['action' => 'edit', $categoriesProduct->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Categories Product'), ['action' => 'delete', $categoriesProduct->id], ['confirm' => __('Are you sure you want to delete # {0}?', $categoriesProduct->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Categories Products'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Categories Product'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="categoriesProducts view content">
            <h3><?= h($categoriesProduct->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Category') ?></th>
                    <td><?= $categoriesProduct->hasValue('category') ? $this->Html->link($categoriesProduct->category->name, ['controller' => 'Categories', 'action' => 'view', $categoriesProduct->category->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Product') ?></th>
                    <td><?= $categoriesProduct->hasValue('product') ? $this->Html->link($categoriesProduct->product->name, ['controller' => 'Products', 'action' => 'view', $categoriesProduct->product->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($categoriesProduct->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
