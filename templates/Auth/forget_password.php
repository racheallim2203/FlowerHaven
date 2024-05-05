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
         <div class="row">
             <div class="col-lg-6 col-12 header-info">
                 <h1>
                     <span class="d-block text-dark bi-log-in" > Forgot Password</span>
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

                <?= $this->Form->button('Send verification email', ['class' => 'btn btn-primary']) ?>
                <?= $this->Form->end() ?>

                <hr class="hr-between-buttons">

                <?= $this->Html->link('Back to login', ['controller' => 'Auth', 'action' => 'login'], ['class' => 'button button-outline']) ?>

            </fieldset>


        </div>
    </div>
</div>
