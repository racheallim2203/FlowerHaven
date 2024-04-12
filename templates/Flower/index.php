<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Flower> $flower
 */
?>
<div class="flower index content">
    <?= $this->Html->link(__('New Flower'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Flower') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('flower_name') ?></th>
                    <th><?= $this->Paginator->sort('flower_price') ?></th>
                    <th><?= $this->Paginator->sort('stock_quantity') ?></th>
                    <th><?= $this->Paginator->sort('category_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($flower as $flower): ?>
                <tr>
                    <td><?= h($flower->id) ?></td>
                    <td><?= h($flower->flower_name) ?></td>
                    <td><?= $this->Number->format($flower->flower_price) ?></td>
                    <td><?= $this->Number->format($flower->stock_quantity) ?></td>
                    <td><?= $flower->hasValue('category') ? $this->Html->link($flower->category->id, ['controller' => 'Category', 'action' => 'view', $flower->category->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $flower->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $flower->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $flower->id], ['confirm' => __('Are you sure you want to delete # {0}?', $flower->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
