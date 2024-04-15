<?php
/**
 * @var \App\View\AppView $this
 */
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Http\Exception\NotFoundException;

$this->layout = 'default2';
$this->assign('title', 'Home');

?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        CakePHP: the rapid development PHP framework:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css(['normalize.min', 'milligram.min', 'fonts', 'cake', 'home']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
<main class="main">
    <!-- Slick Slideshow -->
    <section class="slick-slideshow">
        <div class="slick-custom">
            <img src="<?= $this->Url->image('slideshow/slideshow1.jpg') ?>" class="img-fluid" alt="">
            <div class="slick-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-10">
                            <h1 class="slick-title">Welcome to Blossom Haven</h1>
                            <h3 class="lead text-white mt-lg-3 mb-lg-5">Where Every Petal Tells a Story! Experience the joy of gifting with our seamless delivery service. Your chosen bouquet will arrive fresh and vibrant, ready to brighten someone's day.</h3>
                            <a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'display', 'about']); ?>" class="btn custom-btn">Learn more about us</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="slick-custom">
            <img src="<?= $this->Url->image('slideshow/slideshow2.jpg') ?>" class="img-fluid" alt="">
            <div class="slick-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-10">
                            <h1 class="slick-title"> Explore our Garden of Endless Delights! </h1>
                            <p class="lead text-white mt-lg-3 mb-lg-5">From vibrant roses to delicate orchids, our online florist store is your sanctuary of floral fantasies. Whether you're celebrating love, saying congratulations, or simply sending a smile, our blooms speak volumes.</p>
                            <a href="<?= $this->Url->build('/products'); ?>" class="btn custom-btn">Explore products</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="slick-custom">
            <img src="<?= $this->Url->image('slideshow/slideshow3.jpg') ?>" class="img-fluid" alt="">
            <div class="slick-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-10">
                            <h1 class="slick-title">Handcrafted Bouquets for Every Occasion! 💐</h1>
                            <p class="lead text-white mt-lg-3 mb-lg-5">Browse through our curated collections, each arrangement a masterpiece of color, fragrance, and elegance. Let your emotions bloom with every carefully selected petal.</p>
                            <a href="<?= $this->Url->build('/contact'); ?>" class="btn custom-btn">Work with us</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="mb-5">Get started with <span style="color: #ad18a1">Blossom</span>Heaven</h1>
                </div>

                <div class="col-lg-2 col-12 mt-auto mb-auto">
                    <ul class="nav nav-pills mb-5 mx-auto justify-content-center align-items-center" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Introduction</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-youtube-tab" data-bs-toggle="pill" data-bs-target="#pills-youtube" type="button" role="tab" aria-controls="pills-youtube" aria-selected="true">Our Values</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-skill-tab" data-bs-toggle="pill" data-bs-target="#pills-skill" type="button" role="tab" aria-controls="pills-skill" aria-selected="false">Our Services</button>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-10 col-12">
                    <div class="tab-content mt-2" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="row">
                                <div class="col-lg-7 col-12">
                                    <img src="<?= $this->Url->image('aboutus1.jpg') ?>" class="img-fluid" alt="">
                                </div>
                                <div class="col-lg-5 col-12">
                                    <div class="d-flex flex-column h-100 ms-lg-4 mt-lg-0 mt-5">
                                        <h4  style="font-weight: bolder" class="mb-3">Where <span>Every Petal</span> <br>Tells A <span>Story</span></h4>
                                        <p>Our brand is synonymous with exquisite craftsmanship and unparalleled quality. Each bloom is carefully selected and expertly arranged, ensuring that every bouquet tells a unique story of elegance and refinement.</p>
                                        <div class="mt-2 mt-lg-auto">
                                            <a href="<?= $this->Url->build('/about'); ?>" class="custom-link mb-2">
                                                Learn more about us
                                                <i class="bi-arrow-right ms-2"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-youtube" role="tabpanel" aria-labelledby="pills-youtube-tab">
                            <div class="row">
                                <div class="col-lg-7 col-12">
                                    <img src="<?= $this->Url->image('aboutus2.jpg') ?>" class="img-fluid" alt="">
                                </div>
                                <div class="col-lg-5 col-12">
                                    <div class="d-flex flex-column h-100 ms-lg-4 mt-lg-0 mt-5">
                                        <h4 style="font-weight: bolder" class="mb-3"> Nature's Harmony </h4>
                                        <p>We honor the beauty and resilience of nature, embracing its diversity and nurturing its resources with respect and gratitude.</p>
                                        <p> We uphold the highest standards of craftsmanship and creativity, infusing each creation with passion, skill, and attention to detail.</p>
                                        <div class="mt-2 mt-lg-auto">
                                            <a href="<?= $this->Url->build('/contact'); ?>" class="custom-link mb-2">
                                                Contact Us
                                                <i class="bi-arrow-right ms-2"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-skill" role="tabpanel" aria-labelledby="pills-skill-tab">
                            <div class="row">
                                <div class="col-lg-7 col-12">
                                    <img src="<?= $this->Url->image('aboutus3.jpg') ?>" class="img-fluid" alt="">
                                </div>
                                <div class="col-lg-5 col-12">
                                    <div class="d-flex flex-column h-100 ms-lg-4 mt-lg-0 mt-5">
                                        <h4 class="mb-3" style="font-weight: bolder">Discover the Artistry of FlowerHeaven</h4>
                                        <p style="font-size: 20px">No matter the occasion or sentiment, PetalCraft offers a diverse range of flower arrangements to suit every taste and style. Explore our collection and let your emotions bloom!</p>
                                        <div class="skill-thumb mt-3">
                                            <strong>Arrangements</strong>
                                            <span class="float-end">Vase</span>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%;"></div>
                                            </div>
                                            <strong>Bouquets</strong>
                                            <span class="float-end">Hand-Tied</span>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;"></div>
                                            </div>
                                        </div>
                                        <div class="mt-2 mt-lg-auto">
                                            <a href="<?= $this->Url->build('/products'); ?>" class="custom-link mb-2">
                                                Explore more arrangements
                                                <i class="bi-arrow-right ms-2"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <br><br><br>
    <!-- Next Section -->
    <section class="front-product">
        <div class="container-fluid p-0">
            <div class="row align-items-center">
                <div class="col-lg-6 col-12">
                    <img src="<?= $this->Url->image('aboutus4.jpg'); ?>" class="img-fluid" alt="">
                </div>
                <div class="col-lg-6 col-12">
                    <div class="px-5 py-5 py-lg-0">
                        <h1 class="mb-4"><span style="color: #e632d7">Flower</span>Heaven Florist</h1>
                        <p class=" mb-4">Meet Lily, the passionate soul behind FlowerHeaven, where her love for flowers blossoms into vibrant creations that captivate hearts and souls.</p>
                        <p> As the owner of FlowerHeaven, Lily is committed to sourcing the finest blooms from trusted growers, ensuring each stem is a testament to nature's bounty and beauty. From classic roses to exotic orchids, every flower that graces her shop is handpicked with love and care </p>
                        <a href="<?= $this->Url->build(['controller' => 'Products', 'action' => 'index']); ?>" class="custom-link">
                            Explore Flowers
                            <i class="bi-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section class="featured-product section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h2 class="mb-5" style="font-weight: bolder">Featured Flowers</h2>
                </div>

                <?php
                // Example products array, you might load this from a database
                $products = [
                    ['image' => 'product/evan-mcdougall-qnh1odlqOmk-unsplash.jpeg', 'title' => 'Tree pot', 'description' => 'Original package design from house', 'price' => '$25'],
                    ['image' => 'product/jordan-nix-CkCUvwMXAac-unsplash.jpeg', 'title' => 'Fashion Set', 'description' => 'Costume Package', 'price' => '$35'],
                    ['image' => 'product/nature-zen-3Dn1BZZv3m8-unsplash.jpeg', 'title' => 'Juice Drinks', 'description' => 'Nature made another world', 'price' => '$45']
                ];
                foreach ($products as $product):
                    ?>
                    <div class="col-lg-4 col-12 mb-3">
                        <div class="product-thumb">
                            <a href="<?= $this->Url->build(['controller' => 'Products', 'action' => 'view', $product['title']]); ?>">
                                <img src="<?= $this->Url->image($product['image']); ?>" class="img-fluid product-image" alt="">
                            </a>
                            <div class="product-top d-flex">
                                <span class="product-alert me-auto">New Arrival</span>
                                <a href="#" class="bi-heart-fill product-icon"></a>
                            </div>
                            <div class="product-info d-flex">
                                <div>
                                    <h5 class="product-title mb-0">
                                        <a href="<?= $this->Url->build(['controller' => 'Products', 'action' => 'view', $product['title']]); ?>" class="product-title-link"><?= $product['title']; ?></a>
                                    </h5>
                                    <p class="product-p"><?= $product['description']; ?></p>
                                </div>
                                <small class="product-price text-muted ms-auto mt-auto mb-5"><?= $product['price']; ?></small>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

                <div class="col-12 text-center">
                    <a href="<?= $this->Url->build(['controller' => 'Products', 'action' => 'index']); ?>" class="view-all">View All Products</a>
                </div>
            </div>
        </div>
    </section>
</main>

</body>
</html>
