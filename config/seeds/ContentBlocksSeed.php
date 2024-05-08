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


        ];

        $table = $this->table('content_blocks');
        $table->insert($data)->save();
    }
}
