<footer class="site-footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-10 me-auto mb-4">
                <a class="navbar-brand" href="/" ?>
                    <?= $this->Html->image('F.png', [
                        'alt' => 'FlowerHeaven',
                        'style' => 'height: 120px;'
                    ]) ?>
                </a>
                <p class="copyright-text text-muted mt-lg-5 mb-4 mb-lg-0">Copyright © 2022 <strong>Flower Heaven</strong></p>
            </div>
            <div class="col-lg-5 col-8">
                <h5 class="text-white mb-3">Sitemap</h5>
                <ul class="footer-menu d-flex flex-wrap">
                    <li class="footer-menu-item"><a href="/about" class="footer-menu-link">Story</a></li>
                    <li class="footer-menu-item"><a href="/products" class="footer-menu-link">Products</a></li>
                    <li class="footer-menu-item"><a href="/faq" class="footer-menu-link">FAQs</a></li>
                    <li class="footer-menu-item"><a href="/contact" class="footer-menu-link">Contact</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-4">
                <h5 class="text-white mb-3">Socials</h5>
                <ul class="social-icon" style="font-size: 24px;">
                    <li><a href="#" class="social-icon-link bi-whatsapp"></a></li>
                    <li><a href="#" class="social-icon-link bi-instagram"></a></li>
                    <li><a href="#" class="social-icon-link bi-skype"></a></li>
                    <li><a href="mailto:example@example.com" class="social-icon-link bi-envelope-fill"></a></li>  <!-- Email icon added here -->
                </ul>
            </div>
        </div>
    </div>
</footer>

