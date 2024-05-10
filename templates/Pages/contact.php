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
$this->assign('title', 'Contact Us');
?>

<header class="site-header section-padding-img site-header-image">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-12 header-info">
                <h1>
                    <span class="d-block text-primary">Say hello to us</span>
                    <span class="d-block text-dark">love to hear you</span>
                </h1>
            </div>
        </div>
    </div>
    <?= $this->Html->image('retail-shop-owner-mask-social-distancing-shopping.jpg', ['class' => 'header-image img-fluid', 'alt' => 'Header Image']) ?>
</header>

<section class="contact section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-12 mt-5 ms-auto">
            <h2 class="mb-4">Find Us  <span>Here!</span></h2>
                <div class="row">
                    <div class="col-6 border-end contact-info">
                        <h6 class="mb-3">Email Address</h6>
                        <?= $this->Html->link(
                            'hello@company.com',
                            'mailto:hello@company.com',
                            ['class' => 'custom-link']
                        ) ?>
                    </div>

                    <div class="col-6 contact-info">
                        <h6 class="mb-3">Company Email</h6>
                        <?= $this->Html->link(
                            'studio@company.com',
                            'mailto:studio@company.com',
                            ['class' => 'custom-link']
                        ) ?>
                    </div>

                    <div class="col-6 border-top border-end contact-info">
                        <h6 class="mb-3">Shop Address</h6>
                        <p class="text-muted">Melbourne Central City, VIC</p>
                    </div>

                    <div class="col-6 border-top contact-info">
                        <h6 class="mb-3">Our Socials</h6>
                        <ul class="social-icon">
                            <?= $this->Html->link($this->Html->tag('i', '', ['class' => 'bi-messenger']), '#', ['class' => 'social-icon-link', 'escape' => false]) ?>
                            <?= $this->Html->link($this->Html->tag('i', '', ['class' => 'bi-youtube']), '#', ['class' => 'social-icon-link', 'escape' => false]) ?>
                            <?= $this->Html->link($this->Html->tag('i', '', ['class' => 'bi-instagram']), '#', ['class' => 'social-icon-link', 'escape' => false]) ?>
                            <?= $this->Html->link($this->Html->tag('i', '', ['class' => 'bi-whatsapp']), '#', ['class' => 'social-icon-link', 'escape' => false]) ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-12 mt-5 ms-auto">
                <div class="map-responsive">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3151.843853109464!2d144.963058!3d-37.813628!2m3!1f0!2f0!3f0!3m2!1i1024!1i768!4f13.1!3m3!1m2!1s0x6ad65d5df4cc7b95%3A0x2c3e374529a07223!2sMelbourne%20VIC%2C%20Australia!5e0!3m2!1sen!2sus!4v1651176689154!5m2!1sen!2sus"
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</section>
