<?php
/**
 * @var \App\View\AppView $this
 */

use Cake\Core\Configure;

$debug = Configure::read('debug');

$this->layout = 'default2';
$this->assign('title', 'Login');
?>

<header class="site-header section-padding-img site-header-image front-product">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-12 header-info">
                <h1>
                    <span class="d-block text-dark bi-box-arrow-in-right"> Login</span>
                </h1>
            </div>
        </div>
    </div>
</header>

<div class="container">
    <div class="column column-50 column-offset-25">
        <div class="users form content">

            <?= $this->Form->create() ?>

            <fieldset>

                <?= $this->Flash->render() ?>

                <?php
                /*
                 * NOTE: regarding 'value' config in the login page form controls
                 * In this demo the email and password fields will be filled by demo account
                 * credentials when debug mode is on. You should NOT do that in your production
                 * systems. Also it's a good practice to clear (set password value to empty)
                 * in the view so when an error occurred with form validation, the password
                 * values are always cleared.
                 */
                echo $this->Form->control('email', [
                    'type' => 'email',
                    'required' => true,
                    'label' => 'Email',
                    'placeholder' => 'email@example.com',
                    'class' => 'form-control-login',
                    'autofocus' => true
                ]);
                echo $this->Form->control('password', [
                    'type' => 'password',
                    'required' => true,
                    'label' => 'Password',
                    'placeholder' => 'Password',
                    'class' => 'form-control-login'
                ]);
                ?>
                <?= $this->Form->button('Login', ['class' => 'btn btn-success']) ?>
                <?= $this->Html->link('Forgot password?', ['controller' => 'Auth', 'action' => 'forgetPassword'], ['class' => 'button button-outline']) ?>
                        
                <hr class="hr-between-buttons">

                <?= $this->Html->link('Register new user', ['controller' => 'Auth', 'action' => 'register'], ['class' => 'btn btn-outline-primary']) ?>
                <?= $this->Html->link('Go to Homepage', '/', ['class' => 'btn btn-outline-primary']) ?>
                <?= $this->Form->end() ?>    
            </fieldset>
        </div>
    </div>
</div>
