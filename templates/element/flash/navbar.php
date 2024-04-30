<nav class="navbar navbar-expand-lg">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


            <?= $this->Html->image('F.png', [
                'alt' => 'FlowerHaven',
                'url'=> ['controller' => 'Pages', 'action' => 'index'],
                'style' => 'height: 125px;',// Adjust the height as needed
            ]) ?>


        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <?= $this->Html->link('Home', ['controller' => 'Pages', 'action' => 'display'], ['class' => "nav-link"])?>
                </li>
                <li class="nav-item">
                    <?= $this->Html->link('About', ['controller' => 'Pages', 'action' => 'aboutus'], ['class' => "nav-link"])?>
                </li>
                <li class="nav-item">
                    <?= $this->Html->link('Products', ['controller' => 'Flowers', 'action' => 'customerIndex'], ['class' => "nav-link"])?>
                </li>
                <li class="nav-item">
                    <?= $this->Html->link('Contact Us', ['controller' => 'Pages', 'action' => 'contact'], ['class' => "nav-link"])?>
                </li>
            </ul>

            <div class="d-none d-lg-block">
               <?= $this->Html->link(' Cart', ['controller' => 'flowers', 'action' => 'shopping-cart'], ['class' => "bi-cart custom-icon nav-link"])?>

                <?php if ($this->Identity->isLoggedIn()) : ?>
                        <?= $this->Html->link(' Logout', ['controller' => 'Auth', 'action' => 'logout'], ['class' => "bi-person custom-icon nav-link"]) ?>
                    <?php else : ?>
                        <?= $this->Html->link(' Login', ['controller' => 'Auth', 'action' => 'login'], ['class' => "bi-person custom-icon nav-link"]) ?>
                    <?php endif; ?>
            </div>
        </div>
    </div>
</nav>
