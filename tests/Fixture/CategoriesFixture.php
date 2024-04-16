<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CategoriesFixture
 */
class CategoriesFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 'f0b0986b-a060-4946-862c-bc86be10d745',
                'category_name' => 'Lorem ipsum dolor sit amet',
                'category_description' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
