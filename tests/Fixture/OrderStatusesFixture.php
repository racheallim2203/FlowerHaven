<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * OrderStatusesFixture
 */
class OrderStatusesFixture extends TestFixture
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
                'id' => '900c073a-006c-4b38-bc88-7d2fecb3a9fc',
                'order_type' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
