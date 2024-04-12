<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FlowerTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FlowerTable Test Case
 */
class FlowerTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\FlowerTable
     */
    protected $Flower;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Flower',
        'app.Category',
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
        $config = $this->getTableLocator()->exists('Flower') ? [] : ['className' => FlowerTable::class];
        $this->Flower = $this->getTableLocator()->get('Flower', $config);
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
     * @uses \App\Model\Table\FlowerTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\FlowerTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
