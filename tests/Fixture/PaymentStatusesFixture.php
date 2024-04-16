<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PaymentStatusesFixture
 */
class PaymentStatusesFixture extends TestFixture
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
                'id' => '6aa178f7-7039-40b8-a1e1-247aefc7be28',
                'status_type' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
