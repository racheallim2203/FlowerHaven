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
                    <a class="nav-link active" href="./">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./about">Story</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./our-flowers">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./faq">FAQs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./contact">Contact</a>
                </li>
            </ul>

            <div class="d-none d-lg-block">
                <a href="sign-in.html">
                    <?php if ($this->Identity->isLoggedIn()) : ?>
                        <?= $this->Html->link('Logout', ['controller' => 'Auth', 'action' => 'logout'], ['class' => "bi-person custom-icon me-3"]) ?>
                    <?php else : ?>
                        <?= $this->Html->link('Login', ['controller' => 'Auth', 'action' => 'login'], ['class' => "bi-person custom-icon me-3"]) ?>
                    <?php endif; ?>
                </a>
                <a href="/flowers/shopping-cart" class="bi-bag custom-icon"></a>
            </div>
        </div>
    </div>
</nav>
