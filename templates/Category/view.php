<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category $category
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Category'), ['action' => 'edit', $category->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Category'), ['action' => 'delete', $category->id], ['confirm' => __('Are you sure you want to delete # {0}?', $category->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Category'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Category'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="category view content">
            <h3><?= h($category->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= h($category->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Category Name') ?></th>
                    <td><?= h($category->category_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Category Description') ?></th>
                    <td><?= h($category->category_description) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Flower') ?></h4>
                <?php if (!empty($category->flower)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Flower Name') ?></th>
                            <th><?= __('Flower Description') ?></th>
                            <th><?= __('Flower Price') ?></th>
                            <th><?= __('Stock Quantity') ?></th>
                            <th><?= __('Category Id') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($category->flower as $flower) : ?>
                        <tr>
                            <td><?= h($flower->id) ?></td>
                            <td><?= h($flower->flower_name) ?></td>
                            <td><?= h($flower->flower_description) ?></td>
                            <td><?= h($flower->flower_price) ?></td>
                            <td><?= h($flower->stock_quantity) ?></td>
                            <td><?= h($flower->category_id) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Flower', 'action' => 'view', $flower->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Flower', 'action' => 'edit', $flower->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Flower', 'action' => 'delete', $flower->id], ['confirm' => __('Are you sure you want to delete # {0}?', $flower->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
