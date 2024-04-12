<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * OrderFlowerFixture
 */
class OrderFlowerFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public string $table = 'order_flower';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 'ea810a30-8355-422a-90d2-c451f0ed4dcd',
                'flower_id' => 'Lorem ip',
                'orderdelivery_id' => 'Lorem ip',
                'quantity' => 1,
            ],
        ];
        parent::init();
    }
}
