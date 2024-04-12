<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OrderFlowerTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OrderFlowerTable Test Case
 */
class OrderFlowerTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\OrderFlowerTable
     */
    protected $OrderFlower;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.OrderFlower',
        'app.Flower',
        'app.OrderDelivery',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('OrderFlower') ? [] : ['className' => OrderFlowerTable::class];
        $this->OrderFlower = $this->getTableLocator()->get('OrderFlower', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->OrderFlower);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\OrderFlowerTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\OrderFlowerTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
