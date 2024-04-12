<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * OrderDeliveryFixture
 */
class OrderDeliveryFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public string $table = 'order_delivery';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => '23f87f32-ab66-493d-958c-09afc67c6cda',
                'orderstatus_id' => 'Lorem ip',
                'deliverystatus_id' => 'Lorem ip',
                'order_date' => '2024-04-12',
                'total_amount' => 1.5,
                'delivery_date' => '2024-04-12',
            ],
        ];
        parent::init();
    }
}
