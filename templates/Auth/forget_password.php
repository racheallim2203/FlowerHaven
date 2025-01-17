<?php
/**
 * @var \App\View\AppView $this
 */

 use Cake\Core\Configure;

 $debug = Configure::read('debug');
 
 $this->layout = 'default2';
 $this->assign('title', 'Forget Password');
 ?>
 
 <header class="site-header section-padding-img site-header-image front-product">
     <div class="container">
        <div class="col-lg-7 col-12 header-info">
            <h1>
                <span class="d-block text-dark bi-key"> Forget Password</span> 
            </h1>
        </div>
     </div>
 </header>
 
 <div class="container">
     <div class="column column-50 column-offset-25">
         <div class="users form content">

            <?= $this->Form->create() ?>

            <fieldset>

                <?= $this->Flash->render() ?>

                <p>Enter your email address registered with Flower Haven below to reset your password: </p>

                <?php
                echo $this->Form->control('email', [
                    'type' => 'email',
                    'required' => true,
                    'label' => 'Email',
                    'placeholder' => 'email@example.com',
                    'class' => 'form-control-login',
                    'autofocus' => true
                ]);
                ?>

                <?= $this->Form->button('Send verification email', ['class' => 'btn btn-success']) ?>
                <?= $this->Form->end() ?>

                <hr class="hr-between-buttons">

                <?= $this->Html->link('Back to login', ['controller' => 'Auth', 'action' => 'login'], ['class' => 'btn btn-outline-primary']) ?>
                <?= $this->Html->link('Go to Homepage', '/', ['class' => 'btn btn-outline-primary']) ?>
            </fieldset>


        </div>
    </div>
</div>
