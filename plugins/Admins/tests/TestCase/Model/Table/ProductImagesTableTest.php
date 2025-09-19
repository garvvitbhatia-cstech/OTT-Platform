<?php
declare(strict_types=1);

namespace Admins\Test\TestCase\Model\Table;

use Admins\Model\Table\ProductImagesTable;
use Cake\TestSuite\TestCase;

/**
 * Admins\Model\Table\ProductImagesTable Test Case
 */
class ProductImagesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Admins\Model\Table\ProductImagesTable
     */
    protected $ProductImages;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.Admins.ProductImages',
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
        $config = $this->getTableLocator()->exists('ProductImages') ? [] : ['className' => ProductImagesTable::class];
        $this->ProductImages = $this->getTableLocator()->get('ProductImages', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->ProductImages);

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
