<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
use Cake\Core\Configure;

$debug = Configure::read('debug');

$this->layout = 'default2';
$this->assign('title', 'Change User Password - Users');
?>

<header class="site-header section-padding-img site-header-image front-product">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-12 header-info">
                <h1>
                    <span class="d-block text-dark bi-log-in" > Sign In</span>
                </h1>
            </div>
        </div>
    </div>
</header>

<div class="container">
    <div class="column column-50 column-offset-25">
        <div class="users form content">

            <?= $this->Form->create($user) ?>

            <fieldset>

                <legend>Change Password for <u><?= h($user->first_name) ?> <?= h($user->last_name) ?></u></legend>

                <div class="row">
                    <?php
                    echo $this->Form->control('password', [
                        'label' => 'New Password',
                        'value' => '',  // Ensure password is not sending back to the client side
                        'templateVars' => ['container_class' => 'column']
                    ]);
                    // Validate password by repeating it
                    echo $this->Form->control('password_confirm', [
                        'type' => 'password',
                        'value' => '',  // Ensure password is not sending back to the client side
                        'label' => 'Retype New Password',
                        'templateVars' => ['container_class' => 'column']
                    ]);
                    ?>
                </div>

            </fieldset>

            <?= $this->Form->button('Submit') ?>
            <?= $this->Form->end() ?>

        </div>
    </div>
</div>
