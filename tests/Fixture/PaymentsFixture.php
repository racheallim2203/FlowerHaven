<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PaymentsFixture
 */
class PaymentsFixture extends TestFixture
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
                'id' => '6622035e-3be7-447d-a8fa-f0a736f018b2',
                'orderdelivery_id' => 'Lorem ip',
                'paymentstatus_id' => 'Lorem ip',
                'paymentmethod_id' => 'Lorem ip',
                'user_id' => 'Lorem ip',
            ],
        ];
        parent::init();
    }
}
