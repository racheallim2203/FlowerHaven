<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Flower> $flowers
 */

?>
<header class="site-header section-padding-img site-header-image">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-12 header-info">
                <h1>
                    <span class="d-block" style="color: #ff30c1">Our</span>
                    <span class="d-block text-dark">Flowers</span>
                    <p>A flower for every occasion</p>
                </h1>
            </div>
        </div>
    </div>
    <img src="<?= $this->Url->image('flowerindex.jpg') ?>" class="header-image img-fluid" alt="">
</header>

<div class="container">
    <div class="row mb-4">
        <?= $this->Form->create(null, ['type' => 'get', 'class' => 'form-inline']) ?>
        <div class="col-md-4 mb-3">
            <?= $this->Form->control('search', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Search Flowers', 'value' => $this->request->getQuery('search')]) ?>
        </div>
        <div class="col-md-4 mb-3">
            <?= $this->Form->control('category', [
                'type' => 'select',
                'label' => false,
                'class' => 'form-control',
                'options' => $categories,
                'empty' => 'Select Category',
                'value' => $this->request->getQuery('category'),
            ]) ?>
        </div>
        <div class="col-md-4 mb-3 d-flex">
            <?= $this->Form->button(__('Search'), ['class' => 'btn btn-primary']) ?>
            <?= $this->Html->link('Show All Products', ['action' => 'customerIndex'], ['class' => 'btn btn-secondary ml-2']) ?>
        </div>
        <?= $this->Form->end() ?>
    </div>

    <div class="row">
        <div class="col-12 text-center" style="margin-bottom: -1rem !important;">
            <h2 class="mb-5">All Products</h2>
        </div>

        <?php if (count($flowers) === 0): ?>
            <div class="col-12 text-center" style="margin-bottom: 3rem !important;">
                <p>No flowers available in this category!</p>
            </div>
        <?php else: ?>
            <?php foreach ($flowers as $flower) : ?>
                <div class="col-lg-4 col-12 mb-3">
                    <div class="product-thumb">
                        <?= $this->Html->image(
                            $flower->image,
                            [
                                'alt' => $flower->flower_name,
                                'style' => 'height: 360px; width: 360px;',
                                'url' => ['action' => 'customerView', $flower->id],
                            ]
                        ); ?>
                        <div class="product-info d-flex">
                            <div>
                                <h5 class="product-title mb-0">
                                    <?= $this->Html->link(
                                        h($flower->flower_name),
                                        ['action' => 'customerView', $flower->id]
                                    ); ?>
                                    <small class="product-price text-muted ms-auto mt-1 mb-5 float-right">
                                        <?= $this->Number->currency($flower->flower_price) ?>
                                    </small>
                                </h5>
                                <p class="product-p"><?= h($flower->flower_description) ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <br><br>
            <?php endforeach; ?>
        <?php endif; ?>
        <div class="col-12 text-center">
            <?= $this->Html->link('View All Products', ['action' => 'customerIndex'], ['class' => 'view-all']) ?>
        </div>
    </div>
</div>
