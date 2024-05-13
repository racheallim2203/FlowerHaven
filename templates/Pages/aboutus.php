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
$this->assign('title', 'About Us');

?>

<header class="site-header section-padding-img site-header-image">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-12 header-info">
                <h1>
                    <?= $this->ContentBlock->html('about-banner'); ?>
                </h1>
            </div>
        </div>
    </div>
    <?= $this->ContentBlock->image('about-banner-image', ['class' => 'header-image img-fluid']); ?>
</header>


<section class="team section-padding">
    <div class="container">
        <div class="row">

            <div class="col-12">
                <h2 class="mb-5"><?= $this->ContentBlock->html('about-title'); ?></h2>
            </div>

            <div class="col-lg-4 mb-4 col-12">
                <div class="team-thumb d-flex align-items-center">
                    <img src="<?= $this->Url->image('people/expertise.jpg') ?>" class="img-fluid custom-circle-image team-image me-4" alt="">

                    <div class="team-info">
                        <h5 class="mb-0"><?= $this->ContentBlock->html('about-card-title1'); ?></h5>
                        <strong class="text-muted"><?= $this->ContentBlock->html('about-card-subtitle1'); ?></strong>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn custom-modal-btn" data-bs-toggle="modal" data-bs-target="#expertise">
                            <i class="bi-plus-circle-fill"></i>
                        </button>
                        <div class="modal fade" id="expertise" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"><?= $this->ContentBlock->html('about-card-exp-title1'); ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <?= $this->ContentBlock->html('about-card-desc1'); ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 mb-4 col-12">
                <div class="team-thumb d-flex align-items-center">
                    <img src="<?= $this->Url->image('people/personalised.jpg') ?>" class="img-fluid custom-circle-image team-image me-4" alt="">

                    <div class="team-info">
                        <h5 class="mb-0"><?= $this->ContentBlock->html('about-card-title2'); ?></h5>
                        <strong class="text-muted"><?= $this->ContentBlock->html('about-card-subtitle2'); ?></strong>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn custom-modal-btn" data-bs-toggle="modal" data-bs-target="#personalized">
                            <i class="bi-plus-circle-fill"></i>
                        </button>
                        <div class="modal fade" id="personalized" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"><?= $this->ContentBlock->html('about-card-exp-title2'); ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <?= $this->ContentBlock->html('about-card-desc2'); ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 mb-lg-0 mb-4 col-12">
                <div class="team-thumb d-flex align-items-center">
                    <img src="<?= $this->Url->image('people/retail.jpg') ?>" class="img-fluid custom-circle-image team-image me-4" alt="">

                    <div class="team-info">
                        <h5 class="mb-0"><?= $this->ContentBlock->html('about-card-title3'); ?></h5>
                        <strong class="text-muted"><?= $this->ContentBlock->html('about-card-subtitle3'); ?></strong>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn custom-modal-btn" data-bs-toggle="modal" data-bs-target="#retail">
                            <i class="bi-plus-circle-fill"></i>
                        </button>
                        <div class="modal fade" id="retail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"><?= $this->ContentBlock->html('about-card--exp-title3'); ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <?= $this->ContentBlock->html('about-card-desc3'); ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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


<section class="testimonial section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 mx-auto col-11">
                <h2 class="text-center">Customer love, <br> <span>Flower</span> Haven</h2>
                <div class="slick-testimonial">
                    <div class="slick-testimonial-caption">
                        <p class="lead">
                    <?= $this->ContentBlock->html('testimonial'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
