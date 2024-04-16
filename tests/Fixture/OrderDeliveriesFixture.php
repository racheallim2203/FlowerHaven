<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * OrderDeliveriesFixture
 */
class OrderDeliveriesFixture extends TestFixture
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
                'id' => '0780ec7d-f443-465b-8eef-0423981efec8',
                'orderstatus_id' => 'Lorem ip',
                'deliverystatus_id' => 'Lorem ip',
                'order_date' => '2024-04-16',
                'total_amount' => 1.5,
                'delivery_date' => '2024-04-16',
            ],
        ];
        parent::init();
    }
}
