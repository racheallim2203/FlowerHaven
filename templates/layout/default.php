<?php
// Assuming you have a way to determine the current page/controller/action
$currentController = $this->getRequest()->getParam('controller');
$currentAction = $this->getRequest()->getParam('action');
$activePage = ucfirst($currentController) . '/' . $currentAction;
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
                    'alt' => 'FlowerHeaven',
                    'style' => 'height: 60px;' // Adjust the height as needed
                ]) ?>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item <?= ($activePage == 'Flowers/index') ? 'active' : '' ?>">
                        <?= $this->Html->link('Flowers <span class="sr-only">(current)</span>', ['controller' => 'Flowers', 'action' => 'index'], ['class' => 'nav-link', 'escape' => false]) ?>
                    </li>
                    <li class="nav-item <?= ($activePage == 'Payment/index') ? 'active' : '' ?>">
                        <?= $this->Html->link('Payment', ['controller' => 'Payments', 'action' => 'index'], ['class' => 'nav-link']) ?>
                    </li>
                    <li class="nav-item <?= ($activePage == 'User/index') ? 'active' : '' ?>">
                        <?= $this->Html->link('User', ['controller' => 'Users', 'action' => 'index'], ['class' => 'nav-link']) ?>
                    </li>
                    <li class="nav-item <?= ($activePage == 'Categories/index') ? 'active' : '' ?>">
                        <?= $this->Html->link('Categories', ['controller' => 'Categories', 'action' => 'index'], ['class' => 'nav-link']) ?>
                    </li>
                    <li class="nav-item <?= ($activePage == 'Order/index') ? 'active' : '' ?>">
                        <?= $this->Html->link('Orders', ['controller' => 'OrderDeliveries', 'action' => 'index'], ['class' => 'nav-link']) ?>
                    </li>
                    <li class="nav-item <?= ($activePage == 'Auth/logout') ? 'active' : '' ?>">
                        <?php if ($this->Identity->isLoggedIn()) : ?>
                            <?= $this->Html->link('Log Out', ['controller' => 'Auth', 'action' => 'logout'], ['class' => 'nav-link']) ?>
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

