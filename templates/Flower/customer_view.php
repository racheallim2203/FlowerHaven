<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Flower> $flowers
 */

?>

<div class="container">
    <div class="row">

        <div class="col-12 text-center">
            <h2 class="mb-5">Featured Products</h2>
        </div>


        <?php foreach ($flowers as $flower): ?>
        <div class="col-lg-4 col-12 mb-3">
            <div class="product-thumb">
                <a href="product-detail.html">
                    <img src="images/iris_japonicalow.png" class="img-fluid product-image" alt="">
                </a>

                <div class="product-top d-flex">
                    <span class="product-alert me-auto">New Arrival</span>

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
        <?php endforeach; ?>



        <div class="col-12 text-center">
            <a href="products.html" class="view-all">View All Products</a>
        </div>

    </div>
</div>
