<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OrderDeliveryTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OrderDeliveryTable Test Case
 */
class OrderDeliveryTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\OrderDeliveryTable
     */
    protected $OrderDelivery;

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
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('OrderDelivery') ? [] : ['className' => OrderDeliveryTable::class];
        $this->OrderDelivery = $this->getTableLocator()->get('OrderDelivery', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->OrderDelivery);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\OrderDeliveryTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\OrderDeliveryTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
