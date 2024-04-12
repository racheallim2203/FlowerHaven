<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * DeliveryStatusFixture
 */
class DeliveryStatusFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public string $table = 'delivery_status';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 'c1567d29-9d89-4891-8367-0cba19e26522',
                'delivery_status' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
