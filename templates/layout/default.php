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
                    <li class="nav-item active">
                        <?= $this->Html->link('Flower <span class="sr-only">(current)</span>', ['controller' => 'Flower', 'action' => 'index'], ['class' => 'nav-link', 'escape' => false]) ?>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Payment</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">User</a>
                    </li>
                    <li class="nav-item">
                        <?= $this->Html->link('Category', ['controller' => 'Category', 'action' => 'index'], ['class' => 'nav-link']) ?>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Order</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Log Out</a>
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
</body>
</html>
