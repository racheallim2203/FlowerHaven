<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PaymentMethodFixture
 */
class PaymentMethodFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public string $table = 'payment_method';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => '65310e03-771b-405d-9534-2f1bf092b749',
                'method_type' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
