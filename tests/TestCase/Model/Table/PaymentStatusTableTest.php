<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PaymentStatusTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PaymentStatusTable Test Case
 */
class PaymentStatusTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PaymentStatusTable
     */
    protected $PaymentStatus;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.PaymentStatus',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('PaymentStatus') ? [] : ['className' => PaymentStatusTable::class];
        $this->PaymentStatus = $this->getTableLocator()->get('PaymentStatus', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->PaymentStatus);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\PaymentStatusTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
