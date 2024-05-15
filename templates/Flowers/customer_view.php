<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Flower $flower
 */
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

    <section class="product-detail section-padding" style="background-color: beige;">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div id="flowerCarousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <?= $this->Html->image($flower->image, ['class' => 'd-block w-100', 'alt' => $flower->flower_name]); ?>
                            </div>
                            <?php if ($flower->image2): ?>
                            <div class="carousel-item">
                                <?=$this->Html->image($flower->image2 , ['class' => 'd-block w-100', 'alt' => 'Additional view']);?>
                            </div>
                            <?php endif; ?>
                        </div>
                        <a class="carousel-control-prev" href="#flowerCarousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#flowerCarousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>

                <div class="col-lg-6 col-12">
                    <?= $this->Flash->render() ?>
                    <div class="product-info d-flex">
                        <div>
                            <h2 class="product-title mb-0"><?= h($flower->flower_name); ?></h2>
                        </div>
                    </div>

                    <div class="product-description">
                        <strong class="lead mb-5" style="font-weight: bolder">$<?= h($flower->flower_price); ?></strong>
                        <p class="lead mb-5"style="font-weight: bold"><?= h($flower->flower_description); ?></p>
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
    <div class="col-12 text-center" style="background-color: beige">
        <?= $this->Html->link('View All Products', ['controller' => 'Flowers', 'action' => 'customerIndex'], ['class' => "view-all"])?>
    </div>



</main>
