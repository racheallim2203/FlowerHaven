<?php
// Assuming you have a way to determine the current page/controller/action
$currentController = $this->getRequest()->getParam('controller');
$currentAction = $this->getRequest()->getParam('action');
$activePage = ucfirst($currentController) . '/' . $currentAction;
?>

<nav class="navbar navbar-expand-lg">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


            <?= $this->Html->image('F.png', [
                'alt' => 'FlowerHaven',
                'url'=> ['controller' => 'Pages', 'action' => 'index'],
                'style' => 'height: 50px;',// Adjust the height as needed
            ]) ?>


        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li>
                   <?= $this->Html->link('Home', ['controller' => 'Pages', 'action' => 'display'], ['class' => "nav-link" . ($activePage == 'Pages/display' ? ' active' : '')]) ?> </a>
                </li>
                <li>
                    <?= $this->Html->link('About', ['controller' => 'Pages', 'action' => 'aboutus'], ['class' => "nav-link" . ($activePage == 'Pages/aboutus' ? ' active' : '')])?>
                </li>
                <li>
                    <?= $this->Html->link('Products', ['controller' => 'Flowers', 'action' => 'customerIndex'], ['class' => "nav-link" . ($activePage == 'Flowers/customerIndex' ? ' active' : '')])?>
                </li>
                <li>
                    <?= $this->Html->link('Contact Us', ['controller' => 'Pages', 'action' => 'contact'], ['class' => "nav-link" . ($activePage == 'Pages/contact' ? ' active' : '')])?>
                </li>
            </ul>

            <div class="d-none d-lg-block">
               <?= $this->Html->link(' Cart', ['controller' => 'flowers', 'action' => 'shopping-cart'], ['class' => "bi-cart custom-icon nav-link"  . ($activePage == 'Flowers/customerShoppingCart' ? ' active' : '')])?>

                <?php if ($this->Identity->isLoggedIn()) : ?>
                        <?= $this->Html->link(' Logout', ['controller' => 'Auth', 'action' => 'logout'], ['class' => "bi-person custom-icon nav-link"]) ?>
                    <?php else : ?>
                        <?= $this->Html->link(' Login', ['controller' => 'Auth', 'action' => 'login'], ['class' => "bi-person custom-icon nav-link"]) ?>
                    <?php endif; ?>
            </div>
        </div>
    </div>
</nav>
