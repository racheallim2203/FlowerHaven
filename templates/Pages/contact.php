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
            <div class="col-lg-6 col-12">
                <h2 class="mb-4">Let's <span>begin</span></h2>

                <?= $this->Form->create(null, ['class' => 'contact-form me-lg-5 pe-lg-3', 'role' => 'form']) ?>
                <?= $this->Form->control('name', [
                    'label' => false,
                    'class' => 'form-control',
                    'required' => true,
                    'type' => 'text',
                    'placeholder' => 'Full name'
                ]) ?>
                <br>
                <?= $this->Form->control('email', [
                    'label' => false,
                    'class' => 'form-control',
                    'required' => true,
                    'type' => 'email',
                    'pattern' => '[^ @]*@[^ @]*',
                    'placeholder' => 'Email address'
                ]) ?>
                <br>
                <?= $this->Form->control('subject', [
                    'label' => false,
                    'class' => 'form-control',
                    'required' => true,
                    'type' => 'text',
                    'placeholder' => 'Subject'
                ]) ?>
                <br>
                <?= $this->Form->control('message', [
                    'label' => false,
                    'class' => 'form-control',
                    'required' => true,
                    'type' => 'textarea',
                    'style' => 'height: 160px',
                    'placeholder' => 'Enquiries'
                ]) ?>
                <br>
                <?= $this->Form->button('Send', ['class' => 'btn btn-primary', 'style' => 'width:100%;']) ?>
                <?= $this->Form->end() ?>
            </div>

            <div class="col-lg-6 col-12 mt-5 ms-auto">
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
                        <p class="text-muted">Akershusstranda 20, 0150 Oslo, Norway</p>
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
        </div>
    </div>
</section>
