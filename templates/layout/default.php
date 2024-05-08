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
<div class="container-fluid">
    <div class="w-auto px-2">
        <div class="navbar navbar-expand-xl navbar-light bg-light">
            <a class="navbar-brand" href="<?= $this->Url->build('/') ?>">
                <?= $this->Html->image('F.png', [
                    'alt' => 'FlowerHaven',
                    'url'=> ['controller' => 'Admin', 'action' => 'index'],
                    'style' => 'height: 60px;' // Adjust the height as needed
                ]) ?>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    </li>
                    <li class="nav-item" >
                        <?= $this->Html->link('Flowers', ['controller' => 'Flowers', 'action' => 'index'], ['class' => 'nav-link' . ($activePage == 'Flowers' ? ' active' : '')]) ?>
                    </li>
                    <li class="nav-item" >
                        <?= $this->Html->link('Payment', ['controller' => 'Payments', 'action' => 'adminIndex'], ['class' => 'nav-link' . ($activePage == 'Payments' ? ' active' : '')]) ?>
                    </li>
                    <li class="nav-item" >
                        <?= $this->Html->link('Users', ['controller' => 'Users', 'action' => 'index'], ['class' => 'nav-link' . ($activePage == 'Users' ? ' active' : '')]) ?>
                    </li>
                    <li class="nav-item" >
                        <?= $this->Html->link('Categories', ['controller' => 'Categories', 'action' => 'index'], ['class' => 'nav-link' . ($activePage == 'Categories' ? ' active' : '')]) ?>
                    </li>
                    <li class="nav-item" >
                        <?= $this->Html->link('Orders', ['controller' => 'OrderDeliveries', 'action' => 'index'], ['class' => 'nav-link' . ($activePage == 'OrderDeliveries' ? ' active' : '')]) ?>
                    </li>
                    <li class="nav-item">
                        <?= $this->Html->link('Content Blocks', ['plugin' => 'ContentBlocks', 'controller' => 'ContentBlocks', 'action' => 'index'], ['class' => 'nav-link' . ($activePage == 'ContentBlocks' ? ' active' : '')]) ?>
                    </li>
                </ul>
            </div>
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

