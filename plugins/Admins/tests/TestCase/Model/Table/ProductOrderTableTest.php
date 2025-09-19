<?php
declare(strict_types=1);

namespace Admins\Test\TestCase\Model\Table;

use Admins\Model\Table\ProductOrderTable;
use Cake\TestSuite\TestCase;

/**
 * Admins\Model\Table\ProductOrderTable Test Case
 */
class ProductOrderTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Admins\Model\Table\ProductOrderTable
     */
    protected $ProductOrder;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.Admins.ProductOrder',
        'plugin.Admins.Users',
        'plugin.Admins.Products',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('ProductOrder') ? [] : ['className' => ProductOrderTable::class];
        $this->ProductOrder = $this->getTableLocator()->get('ProductOrder', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->ProductOrder);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
