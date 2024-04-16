<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OldTables\DeliveryStatusTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DeliveryStatusTable Test Case
 */
class DeliveryStatusTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\OldTables\DeliveryStatusTable
     */
    protected $DeliveryStatus;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
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
        $config = $this->getTableLocator()->exists('DeliveryStatus') ? [] : ['className' => DeliveryStatusTable::class];
        $this->DeliveryStatus = $this->getTableLocator()->get('DeliveryStatus', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->DeliveryStatus);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\OldTables\DeliveryStatusTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
