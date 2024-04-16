<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OldTables\FlowerTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FlowerTable Test Case
 */
class FlowerTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\OldTables\FlowerTable
     */
    protected $Flower;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Flowers',
        'app.Categories',
        'app.OrderFlower',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Flowers') ? [] : ['className' => FlowerTable::class];
        $this->Flower = $this->getTableLocator()->get('Flowers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Flower);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\OldTables\FlowerTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\OldTables\FlowerTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
