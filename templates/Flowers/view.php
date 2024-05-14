<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Flower $flower
 */
?>
<br>
<br>
<div class="container-fluid">
    <div class="row">
        <aside class="col-xl-3 col-lg-3 col-md-4 col-sm-12">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0"><?= __('Actions') ?></h4>
                </div>
                <div class="card-body">
                    <?= $this->Html->link(__('List Flowers'), ['action' => 'index'], ['class' => 'btn btn-outline-info btn-block']) ?>
                    <br>
                    <?= $this->Form->postLink(
                        __('Delete Flowers'),
                        ['action' => 'delete', $flower->id],
                        ['confirm' => __('Are you sure you want to delete # {0}?', $flower->id), 'class' => 'btn btn-outline-danger btn-block']
                    ) ?>
                </div>
            </div>
        </aside>
        <div class="col-xl-9 col-lg-9 col-md-8 col-sm-12">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0"><?= __('View Flowers') ?></h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tbody>
                        <tr>
                            <th><?= __('ID') ?></th>
                            <td><?= h($flower->id) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Flowers Name') ?></th>
                            <td><?= h($flower->flower_name) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Flowers Description') ?></th>
                            <td><?= h($flower->flower_description) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Flowers Price') ?></th>
                            <td><?= $this->Number->currency($flower->flower_price) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Stock Quantity') ?></th>
                            <td><?= $this->Number->format($flower->stock_quantity) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Categories') ?></th>
                            <td><?= $flower->has('category') ? $this->Html->link($flower->category->category_name, ['controller' => 'Categories', 'action' => 'view', $flower->category->id]) : __('No Categories') ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Archived') ?></th>
                            <td><?= $flower->isArchived ? __('Yes') : __('No') ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <br><br>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <h4 class="font-weight-bold"><?= __('Related Order Flowers') ?></h4>
                </div>
                <?php if (!empty($flower->order_flowers)) : ?>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead style="background-color: #9e297e; color:white">
                                <tr>
                                    <th><?= __('Id') ?></th>
                                    <th><?= __('Flowers Id') ?></th>
                                    <th><?= __('Quantity') ?></th>
                                    <th class="actions"><?= __('Actions') ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($flower->order_flowers as $orderFlower) : ?>
                                    <tr>
                                        <td><?= h($orderFlower->id) ?></td>
                                        <td><?= $this->Html->link($orderFlower->flower_id, ['controller' => 'Flowers', 'action' => 'view', $orderFlower->flower_id]) ?></td>
                                        <td><?= h($orderFlower->quantity) ?></td>
                                        <td class="actions">
                                            <div class="d-block">
                                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'OrderFlower', 'action' => 'delete', $orderFlower->id], ['confirm' => __('Are you sure you want to delete # {0}?', $orderFlower->id), 'class' => 'btn btn-danger btn-sm']) ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="card-body">
                        <p class="text-muted"><?= __('No related orders found.') ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>


