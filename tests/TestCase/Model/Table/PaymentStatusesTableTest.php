<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PaymentStatusesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PaymentStatusesTable Test Case
 */
class PaymentStatusesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PaymentStatusesTable
     */
    protected $PaymentStatuses;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.PaymentStatuses',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('PaymentStatuses') ? [] : ['className' => PaymentStatusesTable::class];
        $this->PaymentStatuses = $this->getTableLocator()->get('PaymentStatuses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->PaymentStatuses);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\PaymentStatusesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
