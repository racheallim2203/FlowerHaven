<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Flower $flower
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Flowers'), ['action' => 'edit', $flower->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Flowers'), ['action' => 'delete', $flower->id], ['confirm' => __('Are you sure you want to delete # {0}?', $flower->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Flowers'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Flowers'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="flowers view content">
            <h3><?= h($flower->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= h($flower->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Flowers Name') ?></th>
                    <td><?= h($flower->flower_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Categories') ?></th>
                    <td><?= $flower->hasValue('category') ? $this->Html->link($flower->category->id, ['controller' => 'Categories', 'action' => 'view', $flower->category->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Image') ?></th>
                    <td><?= h($flower->image) ?></td>
                </tr>
                <tr>
                    <th><?= __('Flowers Price') ?></th>
                    <td><?= $this->Number->format($flower->flower_price) ?></td>
                </tr>
                <tr>
                    <th><?= __('Stock Quantity') ?></th>
                    <td><?= $this->Number->format($flower->stock_quantity) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Flowers Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($flower->flower_description)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Order Flowers') ?></h4>
                <?php if (!empty($flower->order_flowers)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Flowers Id') ?></th>
                            <th><?= __('Orderdelivery Id') ?></th>
                            <th><?= __('Quantity') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($flower->order_flowers as $orderFlower) : ?>
                        <tr>
                            <td><?= h($orderFlower->id) ?></td>
                            <td><?= h($orderFlower->flower_id) ?></td>
                            <td><?= h($orderFlower->orderdelivery_id) ?></td>
                            <td><?= h($orderFlower->quantity) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'OrderFlowers', 'action' => 'view', $orderFlower->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'OrderFlowers', 'action' => 'edit', $orderFlower->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'OrderFlowers', 'action' => 'delete', $orderFlower->id], ['confirm' => __('Are you sure you want to delete # {0}?', $orderFlower->id)]) ?>
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
