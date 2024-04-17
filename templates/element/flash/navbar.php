<?php
$currentController = $this->getRequest()->getParam('controller');
$currentAction = $this->getRequest()->getParam('action');
$activePage = strtolower($currentController) . '/' . strtolower($currentAction);
?>

<nav class="navbar navbar-expand-lg">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <a class="navbar-brand" href="/">
            <?= $this->Html->image('F.png', [
                'alt' => 'FlowerHeaven',
                'style' => 'height: 80px;' // Adjust the height as needed
            ]) ?>
        </a>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item <?= ($activePage == 'Pages/display/home') ? 'active' : '' ?>">
                    <?= $this->Html->link('Home', ['controller' => 'Pages', 'action' => 'display', 'home'], ['class' => 'nav-link']) ?>
                </li>
                <li class="nav-item <?= ($activePage == 'Pages/aboutus') ? 'active' : '' ?>">
                    <?= $this->Html->link('About Us', ['controller' => 'Pages', 'action' => 'aboutus'], ['class' => 'nav-link', 'escape' => false]) ?>
                </li>
                <li class="nav-item <?= ($activePage == 'Flowers/customer_view') ? 'active' : '' ?>">
                    <?= $this->Html->link('Flowers', ['controller' => 'Flowers', 'action' => 'customer_view'], ['class' => 'nav-link', 'escape' => false]) ?>
                </li>
                <li class="nav-item <?= ($activePage == 'Pages/faq') ? 'active' : '' ?>">
                    <?= $this->Html->link('FAQs', ['controller' => 'Pages', 'action' => 'faq'], ['class' => 'nav-link', 'escape' => false]) ?>
                </li>
                <li class="nav-item <?= ($activePage == 'Pages/contact') ? 'active' : '' ?>">
                    <?= $this->Html->link('Contact', ['controller' => 'Pages', 'action' => 'contact'], ['class' => 'nav-link', 'escape' => false]) ?>
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
