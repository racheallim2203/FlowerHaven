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
                            <h1 class="slick-title">Cool Fashion</h1>
                            <p class="lead text-white mt-lg-3 mb-lg-5">Little fashion template comes with total 8 HTML pages provided by Tooplate website.</p>
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
                            <h1 class="slick-title">New Design</h1>
                            <p class="lead text-white mt-lg-3 mb-lg-5">Please share this Little Fashion template to your friends. Thank you for supporting us.</p>
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
                            <h1 class="slick-title">Talk to us</h1>
                            <p class="lead text-white mt-lg-3 mb-lg-5">Tooplate is one of the best HTML CSS template websites for everyone.</p>
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
                    <h2 class="mb-5">Get started with <span>Little</span> Fashion</h2>
                </div>

                <div class="col-lg-2 col-12 mt-auto mb-auto">
                    <ul class="nav nav-pills mb-5 mx-auto justify-content-center align-items-center" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Introduction</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-youtube-tab" data-bs-toggle="pill" data-bs-target="#pills-youtube" type="button" role="tab" aria-controls="pills-youtube" aria-selected="true">How we work?</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-skill-tab" data-bs-toggle="pill" data-bs-target="#pills-skill" type="button" role="tab" aria-controls="pills-skill" aria-selected="false">Capabilities</button>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-10 col-12">
                    <div class="tab-content mt-2" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="row">
                                <div class="col-lg-7 col-12">
                                    <img src="<?= $this->Url->image('pim-chu-z6NZ76_UTDI-unsplash.jpeg') ?>" class="img-fluid" alt="">
                                </div>
                                <div class="col-lg-5 col-12">
                                    <div class="d-flex flex-column h-100 ms-lg-4 mt-lg-0 mt-5">
                                        <h4 class="mb-3">Good <span>Design</span> <br>Ideas for <span>your</span> fashion</h4>
                                        <p>Little Fashion templates come with <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'login']); ?>">sign in</a> / <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'add']); ?>">sign up</a> pages, product listing / product detail, about, FAQs, and contact page.</p>
                                        <p>Since this HTML template is based on Bootstrap 5 CSS library, you can feel free to add more components as you need.</p>
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
                                    <div class="ratio ratio-16x9">
                                        <iframe src="https://www.youtube-nocookie.com/embed/f_7JqPDWhfw?controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-12">
                                    <div class="d-flex flex-column h-100 ms-lg-4 mt-lg-0 mt-5">
                                        <h4 class="mb-3">Life at Studio</h4>
                                        <p>Over three years in business, We’ve had the chance to work on a variety of projects, with companies</p>
                                        <p>Custom work is branding, web design, UI/UX design</p>
                                        <div class="mt-2 mt-lg-auto">
                                            <a href="<?= $this->Url->build('/contact'); ?>" class="custom-link mb-2">
                                                Work with us
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
                                    <img src="<?= $this->Url->image('cody-lannom-G95AReIh_Ko-unsplash.jpeg') ?>" class="img-fluid" alt="">
                                </div>
                                <div class="col-lg-5 col-12">
                                    <div class="d-flex flex-column h-100 ms-lg-4 mt-lg-0 mt-5">
                                        <h4 class="mb-3">What can help you?</h4>
                                        <p>Over three years in business, We’ve had the chance on projects</p>
                                        <div class="skill-thumb mt-3">
                                            <strong>Branding</strong>
                                            <span class="float-end">90%</span>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%;"></div>
                                            </div>
                                            <strong>Design & Strategy</strong>
                                            <span class="float-end">70%</span>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%;"></div>
                                            </div>
                                            <strong>Online Platform</strong>
                                            <span class="float-end">80%</span>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;"></div>
                                            </div>
                                        </div>
                                        <div class="mt-2 mt-lg-auto">
                                            <a href="<?= $this->Url->build('/products'); ?>" class="custom-link mb-2">
                                                Explore products
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

    <!-- Retail Shop Owners Section -->
    <section class="front-product">
        <div class="container-fluid p-0">
            <div class="row align-items-center">
                <div class="col-lg-6 col-12">
                    <img src="<?= $this->Url->image('retail-shop-owner-mask-social-distancing-shopping.jpg'); ?>" class="img-fluid" alt="">
                </div>
                <div class="col-lg-6 col-12">
                    <div class="px-5 py-5 py-lg-0">
                        <h2 class="mb-4"><span>Retail</span> shop owners</h2>
                        <p class="lead mb-4">Credits go to Unsplash and FreePik websites for images used in this Little Fashion by Tooplate.</p>
                        <a href="<?= $this->Url->build(['controller' => 'Products', 'action' => 'index']); ?>" class="custom-link">
                            Explore Products
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
                    <h2 class="mb-5">Featured Flowers</h2>
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
