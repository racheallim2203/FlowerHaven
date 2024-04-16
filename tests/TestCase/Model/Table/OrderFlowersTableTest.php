<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OrderFlowersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OrderFlowersTable Test Case
 */
class OrderFlowersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\OrderFlowersTable
     */
    protected $OrderFlowers;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.OrderFlowers',
        'app.Flowers',
        'app.OrderDeliveries',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('OrderFlowers') ? [] : ['className' => OrderFlowersTable::class];
        $this->OrderFlowers = $this->getTableLocator()->get('OrderFlowers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->OrderFlowers);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\OrderFlowersTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\OrderFlowersTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
