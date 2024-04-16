<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\OrderFlowerController Test Case
 *
 * @uses \OLDFILES\OLDCONTROLLERS\OrderFlowerController
 */
class OrderFlowerControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.OrderFlower',
        'app.Flowers',
        'app.OrderDelivery',
    ];

    /**
     * Test index method
     *
     * @return void
     * @uses \OLDFILES\OLDCONTROLLERS\OrderFlowerController::index()
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     * @uses \OLDFILES\OLDCONTROLLERS\OrderFlowerController::view()
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     * @uses \OLDFILES\OLDCONTROLLERS\OrderFlowerController::add()
     */
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     * @uses \OLDFILES\OLDCONTROLLERS\OrderFlowerController::edit()
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     * @uses \OLDFILES\OLDCONTROLLERS\OrderFlowerController::delete()
     */
    public function testDelete(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
