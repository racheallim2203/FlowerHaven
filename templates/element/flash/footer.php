<?php
// Fetching the currently authenticated user object
$user = $this->Identity->get();
?>

<footer class="site-footer mt-10">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-10 me-auto mb-4">
                <a class="navbar-brand" ?>
                    <?= $this->ContentBlock->image('Logo', ['style'=> 'height: 120px']); ?>
                </a>
                <p class="copyright-text text-muted mt-lg-5 mb-4 mb-lg-0"><?= $this->ContentBlock->html('copyright-message'); ?></p>
            </div>
            <div class="col-lg-5 col-8">
                <h5 class="text-white mb-3">Sitemap</h5>
                <ul class="footer-menu d-flex flex-wrap">
                    <li class="footer-menu-item"><?= $this->Html->link('Home', ['class' => 'footer-menu-link', 'controller' => 'Pages', 'action' => 'display'])?></li>
                    <li class="footer-menu-item"><?= $this->Html->link('About', ['class' => 'footer-menu-link', 'controller' => 'Pages', 'action' => 'aboutus'])?></li>
                    <li class="footer-menu-item"><?= $this->Html->link('Our Flowers', ['class' => 'footer-menu-link', 'controller' => 'Flowers', 'action' => 'customerIndex'])?></li>
                    <li class="footer-menu-item"><?= $this->Html->link('Contact', ['class' => 'footer-menu-link', 'controller' => 'Pages', 'action' => 'contact'])?></li>
                    <?php if ($user && $user->isAdmin): ?>
                        <li class="footer-menu-item"><?= $this->Html->link('Admin Dashboard', ['class' => 'footer-menu-link', 'controller' => 'Flowers', 'action' => 'index'])?></li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="col-lg-3 col-4">
                <h5 class="text-white mb-3">Socials</h5>
                <ul class="social-icon" style="font-size: 24px;">
                    <?= $this->ContentBlock->html('social-media'); ?>
                </ul>
            </div>
        </div>
    </div>
</footer>

