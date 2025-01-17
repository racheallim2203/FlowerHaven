<?php
// Assuming you have a way to determine the current page/controller/action
$currentController = $this->getRequest()->getParam('controller');
$currentAction = $this->getRequest()->getParam('action');
$activePage = ucfirst($currentController);
$this->Flash->render();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset('UTF-8') ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?= $this->Html->css(['https://fonts.googleapis.com/css?family=Open+Sans:300,400,600', 'fontawesome.min', 'fullcalendar.min', 'bootstrap.min', 'tooplate']) ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->Html->script(['jquery-3.3.1.min', 'moment.min', 'utils', 'Chart.min', 'fullcalendar.min', 'bootstrap.min', 'tooplate-scripts']) ?>
</head>

<body id="reportsPage">
<!-- Navbar specifications for admin dashboard -->
<div class="container-fluid">
    <div class="w-auto px-2">
        <div class="navbar navbar-expand-xl navbar-light bg-light">
            <!-- Content Block for logo's image -->
            <a class="navbar-brand" href="<?= $this->Url->build('/') ?>">
                <?= $this->ContentBlock->image('Logo', ['style' => 'height: 60px', 'url'=> ['controller' => 'Pages', 'action' => 'display']]); ?>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <!-- Navigation button that links to admin flowers page -->
                    <li class="nav-item" >
                        <?= $this->Html->link('Flowers', ['controller' => 'Flowers', 'action' => 'index'], ['class' => 'nav-link' . ($activePage == 'Flowers' ? ' active' : '')]) ?>
                    </li>
                    <!-- Navigation button that links to admin payment page -->
                    <li class="nav-item" >
                        <?= $this->Html->link('Payment', ['controller' => 'Payments', 'action' => 'adminIndex'], ['class' => 'nav-link' . ($activePage == 'Payments' ? ' active' : '')]) ?>
                    </li>
                    <!-- Navigation button that links to admin users page -->
                    <li class="nav-item" >
                        <?= $this->Html->link('Users', ['controller' => 'Users', 'action' => 'index'], ['class' => 'nav-link' . ($activePage == 'Users' ? ' active' : '')]) ?>
                    </li>
                    <!-- Navigation button that links to admin categories page -->
                    <li class="nav-item" >
                        <?= $this->Html->link('Categories', ['controller' => 'Categories', 'action' => 'index'], ['class' => 'nav-link' . ($activePage == 'Categories' ? ' active' : '')]) ?>
                    </li>
                    <!-- Navigation button that links to admin orders page -->
                    <li class="nav-item" >
                        <?= $this->Html->link('Orders', ['controller' => 'OrderDeliveries', 'action' => 'index'], ['class' => 'nav-link' . ($activePage == 'OrderDeliveries' ? ' active' : '')]) ?>
                    </li>
                    <!-- Navigation button that links to admin content blocks page -->
                    <li class="nav-item">
                        <?= $this->Html->link('Content Blocks', ['plugin' => 'ContentBlocks', 'controller' => 'ContentBlocks', 'action' => 'index'], ['class' => 'nav-link' . ($activePage == 'ContentBlocks' ? ' active' : '')]) ?>
                    </li>
                    <!-- Navigation button that links to customer home page -->
                    <li class="nav-item">
                        <?= $this->Html->link('Customer View', ['controller' => 'Pages', 'action' => 'display'], ['class' => 'nav-link' . ($activePage == 'Pages' ? ' active' : '')]) ?>
                    </li>
                </ul>
            </div>
            <!-- Logout button -->
            <div class="d-none d-lg-block" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item <?= ($activePage == 'Auth/logout') ? 'active' : '' ?>">
                        <?php if ($this->Identity->isLoggedIn()) : ?>
                            <?= $this->Html->link('Logout', ['controller' => 'Auth', 'action' => 'logout'], ['class' => 'nav-link']) ?>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<main class="main">
    <div class="container">
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
    </div>
</main>
<footer>
    <!-- Footer content here -->
</footer>
<?= $this->fetch('script') ?>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const navItems = document.querySelectorAll('.nav-item');

        navItems.forEach(item => {
            item.addEventListener('click', function () {
                navItems.forEach(navItem => {
                    navItem.classList.remove('active');
                });

                this.classList.add('active');
            });
        });
    });
</script>

</body>
</html>

