<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\PaymentMethodController Test Case
 *
 * @uses \OLDFILES\OLDCONTROLLERS\PaymentMethodController
 */
class PaymentMethodControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.PaymentMethod',
    ];

    /**
     * Test index method
     *
     * @return void
     * @uses \OLDFILES\OLDCONTROLLERS\PaymentMethodController::index()
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     * @uses \OLDFILES\OLDCONTROLLERS\PaymentMethodController::view()
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     * @uses \OLDFILES\OLDCONTROLLERS\PaymentMethodController::add()
     */
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     * @uses \OLDFILES\OLDCONTROLLERS\PaymentMethodController::edit()
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     * @uses \OLDFILES\OLDCONTROLLERS\PaymentMethodController::delete()
     */
    public function testDelete(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
