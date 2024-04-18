<?php
/**
 * @var \App\View\AppView $this
 */
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Http\Exception\NotFoundException;

$this->layout = 'default2';
$this->assign('title', 'faq');
?>

    <header class="site-header section-padding-img site-header-image">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12 header-info">
                    <h1>
                        <span class="d-block" style="color: #ff30c1">Flower</span>
                        <span class="d-block text-dark">Haven</span>
                        <p>FAQ PLACEHOLDER</p>
                    </h1>
                </div>
            </div>
        </div>
        <img src="<?= $this->Url->image('header/aboutus.jpg') ?>" class="header-image img-fluid" alt="">
    </header>


    <section class="team section-padding">
        <div class="container">
            <div class="row">

                <div class="col-12">
                    <h2 class="mb-5">What do we do at <span>Flower</span>Haven</h2>
                </div>

                <div class="col-lg-4 mb-4 col-12">
                    <div class="team-thumb d-flex align-items-center">
                        <img src="<?= $this->Url->image('people/expertise.jpg') ?>" class="img-fluid custom-circle-image team-image me-4" alt="">

                        <div class="team-info">
                            <h5 class="mb-0">Expertise</h5>
                            <strong class="text-muted">Use freshest, most vibrant flowers</strong>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn custom-modal-btn" data-bs-toggle="modal" data-bs-target="#expertise">
                                <i class="bi-plus-circle-fill"></i>
                            </button>
                            <div class="modal fade" id="expertise" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Expert Floristry</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Our team of skilled florists combines expertise with passion to design floral artistry that reflects your personal style and event theme. Using the freshest, most vibrant flowers sourced from trusted growers, we ensure each creation is as unique as it is beautiful.
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 mb-4 col-12">
                    <div class="team-thumb d-flex align-items-center">
                        <img src="<?= $this->Url->image('people/personalised.jpg') ?>" class="img-fluid custom-circle-image team-image me-4" alt="">

                        <div class="team-info">
                            <h5 class="mb-0">Personalized</h5>
                            <strong class="text-muted">Tailoring occasions</strong>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn custom-modal-btn" data-bs-toggle="modal" data-bs-target="#personalized">
                                <i class="bi-plus-circle-fill"></i>
                            </button>
                            <div class="modal fade" id="personalized" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Personalized Services</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Understanding that every occasion is special, we offer personalized consultations either in-store or online to tailor our floral services to your specific needs. Whether you’re planning a large event or sending a personal gift, our team is here to guide you every step of the way.
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 mb-lg-0 mb-4 col-12">
                    <div class="team-thumb d-flex align-items-center">
                        <img src="<?= $this->Url->image('people/retail.jpg') ?>" class="img-fluid custom-circle-image team-image me-4" alt="">

                        <div class="team-info">
                            <h5 class="mb-0">Retail Online</h5>
                            <strong class="text-muted">Online and In Store</strong>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn custom-modal-btn" data-bs-toggle="modal" data-bs-target="#retail">
                                <i class="bi-plus-circle-fill"></i>
                            </button>
                            <div class="modal fade" id="retail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Online and In-Store</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Visit us at our welcoming shop or browse our extensive online gallery to find the perfect floral expression. With our convenient delivery service, beautiful flowers are just a click away.
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <section class="testimonial section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 mx-auto col-11">
                    <h2 class="text-center">Customer love, <br> <span>Flower</span> Haven</h2>
                    <div class="slick-testimonial">
                        <div class="slick-testimonial-caption">
                            <p class="lead">
                                Flower Haven never disappoints! I ordered a bouquet for my mother's birthday,
                                and it was absolutely stunning. The flowers were fresh, beautifully arranged,
                                and delivered right on time. Their attention to detail really shines through in their arrangements!</p>
                            <div class="slick-testimonial-client d-flex align-items-center mt-4">
                                <img src="<?= $this->Url->image('people/customer1.jpg') ?>" class="img-fluid custom-circle-image team-image me-3" alt="">
                                <span>George, <strong class="text-muted">Customer</strong></span>
                            </div>
                        </div>
                        <div class="slick-testimonial-caption">
                            <p class="lead">
                                I recently used Flower Haven for my wedding, and I cannot recommend them enough. The floral arrangements were breathtaking, and they worked closely with us to make sure everything was perfect. They truly went above and beyond to make our day special.</p>
                            <div class="slick-testimonial-client d-flex align-items-center mt-4">
                                <img src="<?= $this->Url->image('people/customer2.jpg') ?>" class="img-fluid custom-circle-image team-image me-3" alt="">
                                <span>Sandar, <strong class="text-muted">Customer</strong></span>
                            </div>
                        </div>
                        <div class="slick-testimonial-caption">
                            <p class="lead">
                                I needed a last-minute gift for a friend, and Flower Haven saved the day. Their same-day delivery service is a lifesaver, and my friend loved the eco-friendly packaging. It’s clear they care about sustainability too!</p>
                            <div class="slick-testimonial-client d-flex align-items-center mt-4">
                                <img src="<?= $this->Url->image('people/customer3.jpg') ?>" class="img-fluid custom-circle-image team-image me-3" alt="">
                                <span>Carlos, <strong class="text-muted">Customer</strong></span>
                            </div>
                        </div>
                        <div class="slick-testimonial-caption">
                            <p class="lead">
                                Every time I visit Flower Haven, I’m impressed by the variety of flowers and the knowledge of the staff. They always help me choose the perfect flowers for any occasion, and their passion for what they do is evident.</p>
                            <div class="slick-testimonial-client d-flex align-items-center mt-4">
                                <img src="<?= $this->Url->image('people/customer4.jpg') ?>" class="img-fluid custom-circle-image team-image me-3" alt="">
                                <span>Catherine, <strong class="text-muted">Customer</strong></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
