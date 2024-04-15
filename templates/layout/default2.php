<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->fetch('title') ?></title>
    <?= $this->Html->meta('description', '') ?>
    <?= $this->Html->meta('author', '') ?>

    <!-- CSS FILES -->
    <?= $this->Html->css('https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;700;900&display=swap') ?>
    <?= $this->Html->css('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css') ?>
    <?= $this->Html->css('bootstrap.min') ?>
    <?= $this->Html->css('bootstrap-icons') ?>
    <?= $this->Html->css('slick') ?>
    <?= $this->Html->css('tooplate-little-fashion') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
<?= $this->element('flash/preloader') ?> <!-- Created element for preloader -->

<main>
    <?= $this->element('flash/navbar') ?> <!-- Created element for navbar -->
    <?= $this->fetch('content') ?>
</main>

<footer class="site-footer">
    <?= $this->element('flash/footer') ?> <!-- Created element for footer -->
</footer>

<!-- JAVASCRIPT FILES -->
<?= $this->Html->script('jquery.min') ?>
<?= $this->Html->script('bootstrap.bundle.min') ?>
<?= $this->Html->script('Headroom') ?>
<?= $this->Html->script('jQuery.headroom') ?>
<?= $this->Html->script('slick.min') ?>
<?= $this->Html->script('custom') ?>
</body>
</html>
