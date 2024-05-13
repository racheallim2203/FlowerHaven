<?php

declare(strict_types=1);

use Migrations\AbstractSeed;

class ContentBlocksSeed extends AbstractSeed
{
    public function run(): void
    {
        $data = [
            //Header and Footer
            [
                'parent' => 'Global',
                'label' => 'Copyright Message',
                'description' => 'Copyright information shown at the bottom of the home page.',
                'slug' => 'copyright-message',
                'type' => 'html',
                'value' => 'Copyright © 2024 <strong>Flower Haven</strong>',
            ],
            [
                'parent' => 'Global',
                'label' => 'Logo',
                'description' => 'Logo used in the navbar and footer of the website',
                'slug' => 'Logo',
                'type' => 'image',
                'value' => 'F.png',
            ],
            [
                'parent' => 'Global',
                'label' => 'Social Media',
                'description' => 'Social Media information shown in the footer',
                'slug' => 'social-media',
                'type' => 'html',
                'value' =>
                    '<li><a href="#" class="social-icon-link bi-whatsapp"></a></li>
                    <li><a href="#" class="social-icon-link bi-instagram"></a></li>
                    <li><a href="#" class="social-icon-link bi-skype"></a></li>
                    <li><a href="mailto:example@example.com" class="social-icon-link bi-envelope-fill"></a></li>  <!-- Email icon added here -->',
            ],


            //Slideshow
            [
                'parent' => 'Home Slideshow',
                'label' => 'Slide 1 Title',
                'description' => 'The Title of First Slide in the Homepage',
                'slug' => 'slide1-title',
                'type' => 'text',
                'value' => 'Welcome to Flower Haven',
            ],
            [
                'parent' => 'Home Slideshow',
                'label' => 'Slide 1 Description',
                'description' => 'The Title of First Slide in the Homepage',
                'slug' => 'slide1-desc',
                'type' => 'html',
                'value' => 'Where Every Petal Tells a Story! Experience the joy of gifting with our seamless delivery service. Your chosen bouquet will arrive fresh and vibrant, ready to brighten someone\'s day.',
            ],
            [
                'parent' => 'Home Slideshow',
                'label' => 'Slide 1 Image',
                'description' => 'The Image of Slide 1 in Homepage',
                'slug' => 'slide1-image',
                'type' => 'image',
                'value' => 'slideshow/slideshow1.jpg',
            ],
            /////////
            [
                'parent' => 'Home Slideshow',
                'label' => 'Slide 2 Title',
                'description' => 'The Title of Second Slide in the Homepage',
                'slug' => 'slide2-title',
                'type' => 'text',
                'value' => 'Explore our Garden of Endless Delights!',
            ],
            [
                'parent' => 'Home Slideshow',
                'label' => 'Slide 2 Description',
                'description' => 'The Description of Second Slide in the Homepage',
                'slug' => 'slide2-desc',
                'type' => 'html',
                'value' => 'From vibrant roses to delicate orchids, our online florist store is your sanctuary of floral fantasies.',
            ],
            [
                'parent' => 'Home Slideshow',
                'label' => 'Slide 2 Image',
                'description' => 'The Image of Slide 2 in Homepage',
                'slug' => 'slide2-image',
                'type' => 'image',
                'value' => 'slideshow/slideshow2.jpg',
            ],
            //////////
            [
                'parent' => 'Home Slideshow',
                'label' => 'Slide 3 Title',
                'description' => 'The Title of Third Slide in the Homepage',
                'slug' => 'slide3-title',
                'type' => 'text',
                'value' => 'Handcrafted Bouquets for Every Occasion!',
            ],
            [
                'parent' => 'Home Slideshow',
                'label' => 'Slide 3 Description',
                'description' => 'The Description of Third Slide in the Homepage',
                'slug' => 'slide3-desc',
                'type' => 'html',
                'value' => 'Browse through our curated collections, each arrangement a masterpiece of color, fragrance, and elegance.',
            ],
            [
                'parent' => 'Home Slideshow',
                'label' => 'Slide 3 Image',
                'description' => 'The Image of Slide 3 in Homepage',
                'slug' => 'slide3-image',
                'type' => 'image',
                'value' => 'slideshow/slideshow3.jpg',
            ],
            //Tab Panel
            [
                'parent' => 'Home Tab Panel',
                'label' => 'Big Title',
                'description' => 'The Big Title of the tab pane1 area in Homepage',
                'slug' => 'panelBig-title',
                'type' => 'html',
                'value' => 'Get started with <span style="color: #ad18a1">Flower</span> Haven',
            ],
            [
                'parent' => 'Home Tab Panel',
                'label' => 'Side Title 1',
                'description' => 'The Side Title of Panel 1 in Homepage',
                'slug' => 'panelside1-title',
                'type' => 'text',
                'value' => 'Introduction',
            ],
            [
                'parent' => 'Home Tab Panel',
                'label' => 'Panel 1 Title',
                'description' => 'The Title of Panel 1 in Homepage',
                'slug' => 'panel1-title',
                'type' => 'html',
                'value' => 'Where <span>Every Petal</span> <br>Tells A <span>Story</span>',
            ],
            [
                'parent' => 'Home Tab Panel',
                'label' => 'Panel 1 Description',
                'description' => 'The Description of Panel 1 in Homepage',
                'slug' => 'panel1-desc',
                'type' => 'html',
                'value' => 'Our brand is synonymous with exquisite craftsmanship and unparalleled quality. Each bloom is carefully selected and expertly arranged, ensuring that every bouquet tells a unique story of elegance and refinement.',
            ],
            [
                'parent' => 'Home Tab Panel',
                'label' => 'Panel 1 Image',
                'description' => 'The Image of Panel 1 in Homepage',
                'slug' => 'panel1-image',
                'type' => 'image',
                'value' => 'aboutus1.jpg',
            ],
            /////////
            [
                'parent' => 'Home Tab Panel',
                'label' => 'Side Title 2',
                'description' => 'The Side Title of Panel 2 in Homepage',
                'slug' => 'panelside2-title',
                'type' => 'text',
                'value' => 'Our Values',
            ],
            [
                'parent' => 'Home Tab Panel',
                'label' => 'Panel 2 Title',
                'description' => 'The Title of Panel 2 in Homepage',
                'slug' => 'panel2-title',
                'type' => 'html',
                'value' => 'Nature\'s Harmony',
            ],
            [
                'parent' => 'Home Tab Panel',
                'label' => 'Panel 2 Description',
                'description' => 'The Description of Panel 2 in Homepage',
                'slug' => 'panel2-desc',
                'type' => 'html',
                'value' => 'We honor the beauty and resilience of nature, embracing its diversity and nurturing its resources with respect and gratitude.</br>
                            We uphold the highest standards of craftsmanship and creativity, infusing each creation with passion, skill, and attention to detail.',
            ],
            [
                'parent' => 'Home Tab Panel',
                'label' => 'Panel 2 Image',
                'description' => 'The Image of Panel 2 in Homepage',
                'slug' => 'panel2-image',
                'type' => 'image',
                'value' => '',
            ],
            /////////
            [
                'parent' => 'Home Tab Panel',
                'label' => 'Side Title 3',
                'description' => 'The Side Title of Panel 3 in Homepage',
                'slug' => 'panelside3-title',
                'type' => 'text',
                'value' => 'Our Services',
            ],
            [
                'parent' => 'Home Tab Panel',
                'label' => 'Panel 3 Title',
                'description' => 'The Title of Panel 3 in Homepage',
                'slug' => 'panel3-title',
                'type' => 'html',
                'value' => 'Discover the Artistry of Flower Haven',
            ],
            [
                'parent' => 'Home Tab Panel',
                'label' => 'Panel 3 Description',
                'description' => 'The Description of Panel 3 in Homepage',
                'slug' => 'panel3-desc',
                'type' => 'html',
                'value' => 'No matter the occasion or sentiment, PetalCraft offers a diverse range of flower arrangements to suit every taste and style. Explore our collection and let your emotions bloom!',
            ],
            [
                'parent' => 'Home Tab Panel',
                'label' => 'Panel 3 Image',
                'description' => 'The Image of Panel 3 in Homepage',
                'slug' => 'panel3-image',
                'type' => 'image',
                'value' => 'aboutus3.jpg',
            ],

            //Home Bottom
            [
                'parent' => 'Home Bottom',
                'label' => 'Title',
                'description' => 'The Title at the bottom of the Homepage',
                'slug' => 'bottom-title',
                'type' => 'html',
                'value' => 'Flower</span> Haven Florist',
            ],
            [
                'parent' => 'Home Bottom',
                'label' => 'Description',
                'description' => 'The Description at the bottom of the Homepage',
                'slug' => 'bottom-desc',
                'type' => 'html',
                'value' => 'Meet Lily, the passionate soul behind Flower Haven, where her love for flowers blossoms into vibrant creations that captivate hearts and souls.</br>
                        As the owner of Flower Haven, Lily is committed to sourcing the finest blooms from trusted growers, ensuring each stem is a testament to nature\'s bounty and beauty. From classic roses to exotic orchids, every flower that graces her shop is handpicked with love and care ',
            ],
            [
                'parent' => 'Home Bottom',
                'label' => 'Image',
                'description' => 'The Image at the bottom of the Homepage',
                'slug' => 'bottom-image',
                'type' => 'image',
                'value' => 'aboutus4.jpg',
            ],
            ///About Us Section///
            [
                'parent' => 'About Us',
                'label' => 'Header Banner',
                'description' => 'Text of the Header Banner',
                'slug' => 'about-banner',
                'type' => 'html',
                'value' => '<span class="d-block" style="color: #ff30c1">Flower</span>
                    <span class="d-block text-dark">Haven</span>
                    <p>Where Every Petal Tells A Story</p>',
            ],
            [
                'parent' => 'About Us',
                'label' => 'Header Banner Image',
                'description' => 'Image of the Header Banner',
                'slug' => 'about-banner-image',
                'type' => 'image',
                'value' => 'header/aboutus.jpg',
            ],
            [
                'parent' => 'About Us',
                'label' => 'Page Title',
                'description' => 'Title underneath the Header Banner',
                'slug' => 'about-title',
                'type' => 'html',
                'value' => 'What do we do at <span>Flower</span>Haven',
            ],
            //Card 1
            [
                'parent' => 'About Us Card 1',
                'label' => 'About Card Title 1',
                'description' => 'Title in the first card',
                'slug' => 'about-card-title1',
                'type' => 'html',
                'value' => 'Expertise',
            ],
            [
                'parent' => 'About Us Card 1',
                'label' => 'About Card Subtitle 1',
                'description' => 'Title in the first card',
                'slug' => 'about-card-subtitle1',
                'type' => 'html',
                'value' => 'Use freshest, most vibrant flowers',
            ],
            [
                'parent' => 'About Us Card 1',
                'label' => 'About Card Expanded Title 1',
                'description' => 'Title of Pop-Up Card',
                'slug' => 'about-card-exp-title1',
                'type' => 'html',
                'value' => 'Expert Floristry',
            ],
            [
                'parent' => 'About Us Card 1',
                'label' => 'About Card Description 1',
                'description' => 'Description of Pop-Up Card',
                'slug' => 'about-card-desc1',
                'type' => 'html',
                'value' => 'Our team of skilled florists combines expertise with passion to design floral artistry that reflects your personal style and event theme. Using the freshest, most vibrant flowers sourced from trusted growers, we ensure each creation is as unique as it is beautiful.',
            ],
            //Card 2
            [
                'parent' => 'About Us Card 2',
                'label' => 'About Card Title 2',
                'description' => 'Title in the second card',
                'slug' => 'about-card-title2',
                'type' => 'html',
                'value' => 'Personalized',
            ],
            [
                'parent' => 'About Us Card 2',
                'label' => 'About Card Subtitle 2',
                'description' => 'Title in the second card',
                'slug' => 'about-card-subtitle2',
                'type' => 'html',
                'value' => 'Tailoring occasions',
            ],
            [
                'parent' => 'About Us Card 2',
                'label' => 'About Card Expanded Title 2',
                'description' => 'Title of Pop-Up Card',
                'slug' => 'about-card-exp-title2',
                'type' => 'html',
                'value' => 'Personalized Services',
            ],
            [
                'parent' => 'About Us Card 2',
                'label' => 'About Card Description 2',
                'description' => 'Description of Pop-Up Card',
                'slug' => 'about-card-desc2',
                'type' => 'html',
                'value' => 'Understanding that every occasion is special, we offer personalized consultations either in-store or online to tailor our floral services to your specific needs. Whether you’re planning a large event or sending a personal gift, our team is here to guide you every step of the way.',
            ],
            //Card 3
            [
                'parent' => 'About Us Card 3',
                'label' => 'About Card Title 3',
                'description' => 'Title in the third card',
                'slug' => 'about-card-title3',
                'type' => 'html',
                'value' => 'Retail Online',
            ],
            [
                'parent' => 'About Us Card 3',
                'label' => 'About Card Subtitle 3',
                'description' => 'Title in the third card',
                'slug' => 'about-card-subtitle3',
                'type' => 'html',
                'value' => 'Online and In Store',
            ],
            [
                'parent' => 'About Us Card 3',
                'label' => 'About Card Expanded Title 3',
                'description' => 'Title of Pop-Up Card',
                'slug' => 'about-card-exp-title3',
                'type' => 'html',
                'value' => 'Online and In-Store',
            ],
            [
                'parent' => 'About Us Card 3',
                'label' => 'About Card Description 3',
                'description' => 'Description of Pop-Up Card',
                'slug' => 'about-card-desc3',
                'type' => 'html',
                'value' => 'Visit us at our welcoming shop or browse our extensive online gallery to find the perfect floral expression. With our convenient delivery service, beautiful flowers are just a click away.',
            ],
            [
                'parent' => 'Testimonial',
                'label' => 'Change the text/ style of the testimonial at the bottom',
                'description' => 'Testimonial html',
                'slug' => 'testimonial',
                'type' => 'html',
                'value' => '
                            Flower Haven never disappoints! I ordered a bouquet for my mother\'s birthday,
                            and it was absolutely stunning. The flowers were fresh, beautifully arranged,
                            and delivered right on time. Their attention to detail really shines through in their arrangements!</p>
                        <div class="slick-testimonial-client d-flex align-items-center mt-4">
                            <img src="<?= $this->Url->image(\'people/customer1.jpg\') ?>" class="img-fluid custom-circle-image team-image me-3" alt="">
                            <span>George, <strong class="text-muted">Customer</strong></span>
                        </div>',
            ],








        ];

        $table = $this->table('content_blocks');
        $table->insert($data)->save();
    }
}
