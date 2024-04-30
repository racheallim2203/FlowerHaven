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
    <div class="row">

        <div class="col-12 text-center">
            <h2 class="mb-5">All Products</h2>
        </div>


        <?php foreach ($flowers as $flower): ?>
        <div class="col-lg-4 col-12 mb-3">
            <div class="product-thumb">
                <?=$this->Html->image($flower->image, [
                        'alt' => $flower->flower_name,
                        'style' => 'height: 360px;', // Adjust the height as needed
                        'url' => ['action' => 'customerView', $flower->id]
                    ]);
                ?>

                <div class="product-info d-flex">
                    <div>
                        <h5 class="product-title mb-0">

                           <?= $this->Html->link(
                               h($flower->flower_name),
                               ['action' => 'customerView', $flower->id]
                            ); ?>

                            <small class="product-price text-muted ms-auto mt-1 mb-5 float-right "><?= $this->Number->currency($flower->flower_price) ?></small>
                        </h5>
                        <p class="product-p"><?= h($flower->flower_description) ?></p>
                    </div>


                </div>
            </div>
        </div>
        <?php endforeach; ?>

        <div class="col-12 text-center">
            <a href="" class="view-all">View All Products</a>
        </div>
        <br><br><br><br><br>

    </div>
</div>

