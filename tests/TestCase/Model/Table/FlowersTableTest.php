<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FlowersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FlowersTable Test Case
 */
class FlowersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\FlowersTable
     */
    protected $Flowers;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Flowers',
        'app.Categories',
        'app.OrderFlowers',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Flowers') ? [] : ['className' => FlowersTable::class];
        $this->Flowers = $this->getTableLocator()->get('Flowers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Flowers);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\FlowersTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\FlowersTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
