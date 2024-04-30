<?php
/**
 * Login layout
 *
 * This layout comes with no navigation bar and Flash renderer placeholder. Usually used for login page or similar.
 *
 * @var \App\View\AppView $this
 */

use Cake\Core\Configure;

$appLocale = Configure::read('App.defaultLocale');
?>
<!DOCTYPE html>
<html lang="<?= $appLocale ?>">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js') ?>
    <?= $this->Html->script('https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js') ?>
    <!-- CSS FILES -->
    <?= $this->Html->css('https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;700;900&display=swap') ?>
    <?= $this->Html->css('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css') ?>
    <?= $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js', ['block' => 'script'])?>
    <?= $this->Html->script('https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js', ['block' => 'script'])?>
    <?= $this->Html->css('bootstrap-icons') ?>
    <?= $this->Html->css('slick') ?>
    <?= $this->Html->css('font-awesome/css/font-awesome.min.css') ?>
    <?= $this->Html->script('js/jquery-1.10.2.min.js') ?>
    <?= $this->Html->script('bootstrap/js/bootstrap.min.js') ?>
    
    <?= $this->Html->css(['normalize.min', 'milligram.min', 'cake']) ?>
    
    <?= $this->Html->css('tooplate-little-fashion') ?>
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <style>
        header {
            padding-top: 10px;
            text-align: center
        }
        main {
            padding-top: 10px;
            padding-bottom: 20px;
        }
    </style>
</head>

<body>
<header>
    <?= $this->Html->image('F.png', [
        'alt' => 'FlowerHaven',
        'url'=> ['controller' => 'Pages', 'action' => 'index'],
        'style' => 'height: 125px;',// Adjust the height as needed
    ]) ?>
</header>

<main class="main">
    <?= $this->fetch('content') ?>
</main>

<footer class="site-footer">
    <?= $this->element('flash/footer') ?> <!-- Created element for footer -->
</footer>

<!-- JAVASCRIPT FILES -->
<?= $this->Html->script('jquery.min') ?>
<?= $this->Html->script('Headroom') ?>
<?= $this->Html->script('jQuery.headroom') ?>
<?= $this->Html->script('slick.min') ?>
<?= $this->Html->script('custom') ?>
</body>
</html>
