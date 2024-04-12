<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CategoryFixture
 */
class CategoryFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public string $table = 'category';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 'f6b6d414-adae-4b63-92b3-157faa32d1a7',
                'category_name' => 'Lorem ipsum dolor sit amet',
                'category_description' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
