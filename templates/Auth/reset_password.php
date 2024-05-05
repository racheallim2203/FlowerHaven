<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
use Cake\Core\Configure;

 $debug = Configure::read('debug');

 $this->layout = 'default2';
$this->assign('title', 'Reset Password');
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

                <legend>Reset Your Password</legend>

                <?= $this->Flash->render() ?>

                <?php
                echo $this->Form->control('password', [
                    'type' => 'password',
                    'label' => 'New Password',
                    'required' => true,
                    'autofocus' => true,
                    'value' => ''
                ]);
                echo $this->Form->control('password_confirm', [
                    'type' => 'password',
                    'label' => 'Repeat New Password',
                    'required' => true,
                    'value' => ''
                ]);
                ?>

            </fieldset>

            <?= $this->Form->button('Reset Password') ?>
            <?= $this->Form->end() ?>

            <hr class="hr-between-buttons">

            <?= $this->Html->link('Back to login', ['controller' => 'Auth', 'action' => 'login'], ['class' => 'button button-outline']) ?>

        </div>
    </div>
</div>
