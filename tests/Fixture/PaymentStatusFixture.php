<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PaymentStatusFixture
 */
class PaymentStatusFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public string $table = 'payment_status';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 'e746f4fa-69a0-4094-a955-bbdb04903127',
                'status_type' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
