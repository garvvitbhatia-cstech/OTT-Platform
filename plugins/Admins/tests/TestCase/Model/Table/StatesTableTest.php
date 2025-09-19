<?php
declare(strict_types=1);

namespace Admins\Test\TestCase\Model\Table;

use Admins\Model\Table\StatesTable;
use Cake\TestSuite\TestCase;

/**
 * Admins\Model\Table\StatesTable Test Case
 */
class StatesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Admins\Model\Table\StatesTable
     */
    protected $States;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.Admins.States',
        'plugin.Admins.Countries',
        'plugin.Admins.Cities',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('States') ? [] : ['className' => StatesTable::class];
        $this->States = $this->getTableLocator()->get('States', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->States);

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
