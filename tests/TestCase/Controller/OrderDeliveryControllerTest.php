<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\OrderDeliveryController Test Case
 *
 * @uses \OLDFILES\OLDCONTROLLERS\OrderDeliveryController
 */
class OrderDeliveryControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.OrderDelivery',
        'app.OrderStatus',
        'app.DeliveryStatus',
    ];

    /**
     * Test index method
     *
     * @return void
     * @uses \OLDFILES\OLDCONTROLLERS\OrderDeliveryController::index()
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     * @uses \OLDFILES\OLDCONTROLLERS\OrderDeliveryController::view()
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     * @uses \OLDFILES\OLDCONTROLLERS\OrderDeliveryController::add()
     */
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     * @uses \OLDFILES\OLDCONTROLLERS\OrderDeliveryController::edit()
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     * @uses \OLDFILES\OLDCONTROLLERS\OrderDeliveryController::delete()
     */
    public function testDelete(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
