<nav class="navbar navbar-expand-lg">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <a class="navbar-brand" href="/">
            <?= $this->Html->image('F.png', [
                'alt' => 'FlowerHeaven',
                'style' => 'height: 50px;' // Adjust the height as needed
            ]) ?>
        </a>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="../team036-app_fit3047/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../team036-app_fit3047/about">Story</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../team036-app_fit3047/our-flowers">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../team036-app_fit3047/faq">FAQs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../team036-app_fit3047/contact">Contact</a>
                </li>
            </ul>

            <div class="d-none d-lg-block">
                <a href="sign-in.html">
                    <?php if ($this->Identity->isLoggedIn()) : ?>
                        <?= $this->Html->link('', ['controller' => 'Auth', 'action' => 'login'], ['class' => "bi-person custom-icon me-3"]) ?>
                    <?php endif; ?>
                </a>
                <a href="product-detail.html" class="bi-bag custom-icon"></a>
            </div>
        </div>
    </div>
</nav>
