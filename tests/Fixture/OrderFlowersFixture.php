<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * OrderFlowersFixture
 */
class OrderFlowersFixture extends TestFixture
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
                'id' => '86e4c7f6-4b6e-490d-875e-e0b8932c7317',
                'flower_id' => 'Lorem ip',
                'orderdelivery_id' => 'Lorem ip',
                'quantity' => 1,
            ],
        ];
        parent::init();
    }
}
