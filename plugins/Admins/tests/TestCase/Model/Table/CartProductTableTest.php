<?php
declare(strict_types=1);

namespace Admins\Test\TestCase\Model\Table;

use Admins\Model\Table\CartProductTable;
use Cake\TestSuite\TestCase;

/**
 * Admins\Model\Table\CartProductTable Test Case
 */
class CartProductTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Admins\Model\Table\CartProductTable
     */
    protected $CartProduct;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.Admins.CartProduct',
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
        $config = $this->getTableLocator()->exists('CartProduct') ? [] : ['className' => CartProductTable::class];
        $this->CartProduct = $this->getTableLocator()->get('CartProduct', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->CartProduct);

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
