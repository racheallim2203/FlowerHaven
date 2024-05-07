<?php
$this->layout = 'default2';
$this->assign('title', 'Missing Action');
?>

<header class="site-header section-padding-img site-header-image front-product">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-12 header-info">
                <h1>
                    <span class="d-block text-dark" >Page Not Found</span>
                    <p>The page you were looking for was not found. (Error: Missing Action)</p>
                    <a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'display', 'home']); ?>" class="btn custom-btn">Return to Home</a>
                </h1>
            </div>
        </div>
    </div>
</header>
