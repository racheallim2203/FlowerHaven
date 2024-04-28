<nav class="navbar navbar-expand-lg">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


            <?= $this->Html->image('F.png', [
                'alt' => 'FlowerHaven',
                'url'=> ['controller' => 'Pages', 'action' => 'display'],
                'style' => 'height: 50px;',// Adjust the height as needed
            ]) ?>


        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link">  <?= $this->Html->link('Home', ['controller' => 'Pages', 'action' => 'display'])?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"><?= $this->Html->link('About', ['controller' => 'Pages', 'action' => 'aboutus'])?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"><?= $this->Html->link('Products', ['controller' => 'Flowers', 'action' => 'customerIndex'])?></a>
                </li>
<!--                <li class="nav-item">-->
<!--                    <a class="nav-link">--><?php //= $this->Html->link('FAQ', ['controller' => 'Pages', 'action' => 'faq'])?><!--</a>-->
<!--                </li>-->
                <li class="nav-item">
                    <a class="nav-link"> <?= $this->Html->link('Contact Us', ['controller' => 'Pages', 'action' => 'contact'])?></a>
                </li>
            </ul>

            <div class="d-none d-lg-block">
                <a>
                    <?php if ($this->Identity->isLoggedIn()) : ?>
                        <?= $this->Html->link('Logout', ['controller' => 'Auth', 'action' => 'logout'], ['class' => "bi-person custom-icon me-3"]) ?>
                    <?php else : ?>
                        <?= $this->Html->link('Login', ['controller' => 'Auth', 'action' => 'login'], ['class' => "bi-person custom-icon me-3"]) ?>
                    <?php endif; ?>
                </a>
                <a class="bi-bag custom-icon"<?= $this->Html->link('Cart', ['controller' => 'flowers', 'action' => 'shopping-cart'])?></a>
            </div>
        </div>
    </div>
</nav>
