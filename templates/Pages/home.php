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
<body>
<main class="main">
    <!-- Slick Slideshow -->
    <section class="slick-slideshow">
        <div class="slick-custom">
            <?= $this->ContentBlock->image('slide1-image', ['class' => 'img-fluid']); ?>
            <div class="slick-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-10">
                            <h1 class="slick-title"><?= $this->ContentBlock->text('slide1-title'); ?></h1>
                            <p class="lead text-white mt-lg-3 mb-lg-5"><?= $this->ContentBlock->html('slide1-desc'); ?></p>
                            <a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'display', 'aboutus']); ?>" class="btn custom-btn">Learn more about us</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="slick-custom">
            <?= $this->ContentBlock->image('slide2-image', ['class' => 'img-fluid']); ?>
            <div class="slick-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-10">
                            <h1 class="slick-title"><?= $this->ContentBlock->text('slide2-title'); ?> </h1>
                            <p class="lead text-white mt-lg-3 mb-lg-5"><?= $this->ContentBlock->html('slide2-desc'); ?></p>
                            <a href="<?= $this->Url->build(['controller' => 'flowers', 'action' =>'customerIndex']); ?>" class="btn custom-btn">Explore products</a><br><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="slick-custom">
            <?= $this->ContentBlock->image('slide3-image', ['class' => 'img-fluid']); ?>
            <div class="slick-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-10">
                            <h1 class="slick-title"><?= $this->ContentBlock->text('slide3-title'); ?> </h1>
                            <p class="lead text-white mt-lg-3 mb-lg-5"><?= $this->ContentBlock->html('slide3-desc'); ?></p>
                            <a href="<?= $this->Url->build(['controller' => 'Pages', 'action' =>'contact']); ?>" class="btn custom-btn">Contact Us</a>
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
                    <h1 class="mb-5"> <?= $this->ContentBlock->html('panel1-title'); ?></h1>
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
                                    <?= $this->ContentBlock->image('panel1-image', ['class' => 'img-fluid']); ?>
                                </div>
                                <div class="col-lg-5 col-12">
                                    <div class="d-flex flex-column h-100 ms-lg-4 mt-lg-0 mt-5">
                                        <h4  style="font-weight: bolder" class="mb-3"><?= $this->ContentBlock->html('panel1-title'); ?></h4>
                                        <p><?= $this->ContentBlock->html('panel1-desc'); ?></p>
                                        <div class="mt-2 mt-lg-auto">
                                            <a href="<?= $this->Url->build(['controller' => 'Pages', 'action' =>'aboutus']); ?>" class="custom-link mb-2">
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
                                    <?= $this->ContentBlock->image('panel2-image', ['class' => 'img-fluid']); ?>
                                </div>
                                <div class="col-lg-5 col-12">
                                    <div class="d-flex flex-column h-100 ms-lg-4 mt-lg-0 mt-5">
                                        <h4 style="font-weight: bolder" class="mb-3"><?= $this->ContentBlock->html('panel2-title'); ?> </h4>
                                        <p><?= $this->ContentBlock->html('panel2-desc'); ?></p>
                                        <div class="mt-2 mt-lg-auto">
                                            <a href="<?= $this->Url->build(['controller' => 'Pages', 'action' =>'contact']); ?>" class="custom-link mb-2">
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
                                    <?= $this->ContentBlock->image('panel3-image', ['class' => 'img-fluid']); ?>
                                </div>
                                <div class="col-lg-5 col-12">
                                    <div class="d-flex flex-column h-100 ms-lg-4 mt-lg-0 mt-5">
                                        <h4 class="mb-3" style="font-weight: bolder"><?= $this->ContentBlock->html('panel3-title'); ?></h4>
                                        <p style="font-size: 20px"><?= $this->ContentBlock->html('panel3-desc'); ?></p>
                                        <div class="mt-2 mt-lg-auto">
                                            <?= $this->Html->link('Explore more arrangements', ['class' => 'custom-link mb2', 'controller' => 'Flowers', 'action' => 'customerIndex'])?>
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
                    <?= $this->ContentBlock->image('bottom-image', ['class' => 'img-fluid']); ?>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="px-5 py-5 py-lg-0">
                        <h1 class="mb-4"><span style="color: #e632d7"><?= $this->ContentBlock->html('bottom-title'); ?></h1>
                        <p class=" mb-4"><?= $this->ContentBlock->html('bottom-desc'); ?></p>
                        <a href="<?= $this->Url->build(['controller' => 'Flowers', 'action' =>'customerIndex']); ?>" class="custom-link mb-2">
                            Explore Flowers
                            <i class="bi-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <br><br>

</main>

</body>
</html>
