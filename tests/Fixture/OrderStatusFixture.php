<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * OrderStatusFixture
 */
class OrderStatusFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public string $table = 'order_status';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => '04344f62-e2ae-4c32-b3fd-a411d616c4e5',
                'order_type' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
