<?php
$this->layout = 'default2';
$this->assign('title', 'Error 401');
?>
<header class="site-header section-padding-img site-header-image front-product">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-12 header-info">
                <h1>
                    <span class="d-block text-dark" >401 Unauthorised</span>
                    <p>Sorry, you do not have permission to view this directory or page using the credentials you supplied.</p>
                    <a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'display', 'home']); ?>" class="btn custom-btn">Return to Home</a>
                </h1>
            </div>
        </div>
    </div>
</header>
