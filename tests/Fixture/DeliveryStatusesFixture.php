<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * DeliveryStatusesFixture
 */
class DeliveryStatusesFixture extends TestFixture
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
                'id' => '8246bf09-0545-4bff-a6e3-df85f7c59101',
                'delivery_status' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
