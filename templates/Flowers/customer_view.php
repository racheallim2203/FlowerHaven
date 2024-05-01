<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Flower $flower
 */
$this->Flash->render();
?>

<section class="preloader">
    <div class="spinner">
        <span class="sk-inner-circle"></span>
    </div>
</section>

<main>
    <header class="site-header section-padding d-flex justify-content-center align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-12">
                    <h1>
                        <span class="d-block text-primary">We provide you</span>
                        <span class="d-block text-dark">Elegance in Every Petal</span>
                    </h1>
                </div>
            </div>
        </div>
    </header>

    <section class="product-detail section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="product-thumb">
                        <?= $this->Html->image($flower->image, ['class' => 'img-fluid product-image', 'alt' => $flower->flower_name]); ?>
                    </div>
                </div>

                <div class="col-lg-6 col-12">
                    <div class="product-info d-flex">
                        <div>
                            <h2 class="product-title mb-0"><?= h($flower->flower_name); ?></h2>
                        </div>
                    </div>

                    <div class="product-description">
                        <strong class="lead mb-5">$<?= h($flower->flower_price); ?></strong>
                        <p class="lead mb-5"><?= h($flower->flower_description); ?></p>
                        <p class="lead"><strong>Available Stock: </strong><?= h($flower->stock_quantity); ?></p> <!-- Displaying stock quantity -->
                    </div>

                    <?= $this->Form->create(null, [
                        'url' => ['controller' => 'Flowers', 'action' => 'addToCart'],
                        'class' => 'product-cart-thumb row'
                    ]) ?>
                    <?= $this->Form->hidden('flower_id', ['value' => $flower->id]); ?> <!-- Ensuring flower ID is included for cart operations -->
                    <div class="col-lg-6 col-12">
                        <?= $this->Form->control('quantity', [
                            'type' => 'select',
                            'label' => false,
                            'options' => range(0, min(5, $flower->stock_quantity)),
                            'class' => 'form-select cart-form-select',
                            'default' => 1
                        ]); ?>
                    </div>
                    <div class="col-lg-6 col-12 mt-4 mt-lg-0">
                        <?= $this->Form->button('Add to Cart', ['class' => 'btn custom-btn cart-btn']); ?>
                    </div>
                    <?= $this->Form->end(); ?>

                </div>
            </div>
        </div>
    </section>


    <section class="related-product section-padding border-top">
        <div class="container">
            <div class="row">

                <div class="col-12">
                    <h3 class="mb-5">You might also like</h3>
                </div>

                <div class="col-lg-4 col-12 mb-3">
                    <div class="product-thumb">
                        <a href="product-detail.html">
                            <img src="images/product/evan-mcdougall-qnh1odlqOmk-unsplash.jpeg" class="img-fluid product-image" alt="">
                        </a>

                        <div class="product-top d-flex">
                            <span class="product-alert me-auto">New arrival</span>
                            <br><br><br><br><br><br>

                            <a href="#" class="bi-heart-fill product-icon"></a>
                        </div>

                        <div class="product-info d-flex">
                            <div>
                                <h5 class="product-title mb-0">
                                    <a href="product-detail.html" class="product-title-link">Tree pot</a>
                                </h5>

                                <p class="product-p">Original package design from house</p>
                            </div>

                            <small class="product-price text-muted ms-auto mt-auto mb-5">$25</small>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-12 mb-3">
                    <div class="product-thumb">
                        <a href="product-detail.html">
                            <img src="images/product/jordan-nix-CkCUvwMXAac-unsplash.jpeg" class="img-fluid product-image" alt="">
                        </a>

                        <div class="product-top d-flex">
                            <span class="product-alert">Low Price</span>
                            <br><br><br><br><br><br>
                            <a href="#" class="bi-heart-fill product-icon ms-auto"></a>
                        </div>

                        <div class="product-info d-flex">
                            <div>
                                <h5 class="product-title mb-0">
                                    <a href="product-detail.html" class="product-title-link">Fashion set</a>
                                </h5>

                                <p class="product-p">Costume package</p>
                            </div>

                            <small class="product-price text-muted ms-auto mt-auto mb-5">$35</small>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-12 mb-3">
                    <div class="product-thumb">
                        <a href="product-detail.html">
                            <img src="images/product/jordan-nix-CkCUvwMXAac-unsplash.jpeg" class="img-fluid product-image" alt="">
                        </a>

                        <div class="product-top d-flex">
                            <span class="product-alert">Popular Item</span>
                            <br><br><br><br><br><br>
                            <a href="#" class="bi-heart-fill product-icon ms-auto"></a>
                        </div>

                        <div class="product-info d-flex">
                            <div>
                                <h5 class="product-title mb-0">
                                    <a href="product-detail.html" class="product-title-link">Juice Drinks</a>
                                </h5>

                                <p class="product-p">Nature made another world</p>
                            </div>

                            <small class="product-price text-muted ms-auto mt-auto mb-5">$45</small>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

</main>
