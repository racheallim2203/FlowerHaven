<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PaymentFixture
 */
class PaymentFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public string $table = 'payment';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => '8072e544-8b70-4aa0-ac67-29419776923e',
                'orderdelivery_id' => 'Lorem ip',
                'paymentstatus_id' => 'Lorem ip',
                'paymentmethod_id' => 'Lorem ip',
                'user_id' => 'Lorem ip',
            ],
        ];
        parent::init();
    }
}
