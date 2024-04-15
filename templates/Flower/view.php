<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Flower $flower
 */
?>
<br>
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Flower $flower
 */
?>
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
                        __('Delete Flower'),
                        ['action' => 'delete', $flower->id],
                        ['confirm' => __('Are you sure you want to delete # {0}?', $flower->id), 'class' => 'btn btn-outline-danger btn-block']
                    ) ?>
                </div>
            </div>
        </aside>
        <div class="col-xl-9 col-lg-9 col-md-8 col-sm-12">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0"><?= __('View Flower') ?></h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tbody>
                        <tr>
                            <th><?= __('ID') ?></th>
                            <td><?= h($flower->id) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Flower Name') ?></th>
                            <td><?= h($flower->flower_name) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Flower Description') ?></th>
                            <td><?= h($flower->flower_description) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Flower Price') ?></th>
                            <td><?= $this->Number->currency($flower->flower_price) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Stock Quantity') ?></th>
                            <td><?= $this->Number->format($flower->stock_quantity) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Category') ?></th>
                            <td><?= $flower->has('category') ? $this->Html->link($flower->category->category_name, ['controller' => 'Category', 'action' => 'view', $flower->category->id]) : __('No Category') ?></td>
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
                    <h4 class="font-weight-bold"><?= __('Related Order Flower') ?></h4>
                </div>
                <?php if (!empty($flower->order_flower)) : ?>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead style="background-color: #9e297e; color:white">
                                <tr>
                                    <th><?= __('Id') ?></th>
                                    <th><?= __('Flower Id') ?></th>
                                    <th><?= __('Quantity') ?></th>
                                    <th class="actions"><?= __('Actions') ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($flower->order_flower as $orderFlower) : ?>
                                    <tr>
                                        <td><?= $this->Html->link($orderFlower->id, ['controller' => 'OrderFlower', 'action' => 'view', $orderFlower->id]) ?></td>
                                        <td><?= $this->Html->link($orderFlower->flower_id, ['controller' => 'Flower', 'action' => 'view', $orderFlower->flower_id]) ?></td>
                                        <td><?= h($orderFlower->quantity) ?></td>
                                        <td class="actions">
                                            <div class="d-block mb-2">
                                                <?= $this->Html->link(__('View'), ['controller' => 'OrderFlower', 'action' => 'view', $orderFlower->id], ['class' => 'btn btn-info btn-sm']) ?>
                                            </div>
                                            <div class="d-block mb-2">
                                                <?= $this->Html->link(__('Edit'), ['controller' => 'OrderFlower', 'action' => 'edit', $orderFlower->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                            </div>
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

