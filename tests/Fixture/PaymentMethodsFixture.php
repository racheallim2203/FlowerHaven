<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PaymentMethodsFixture
 */
class PaymentMethodsFixture extends TestFixture
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
                'id' => '238c991c-0bbb-4b72-a8e9-0690ffc068bb',
                'method_type' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
