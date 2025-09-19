<?php
declare(strict_types=1);

namespace Admins\Test\TestCase\Model\Table;

use Admins\Model\Table\EmailTemplatesTable;
use Cake\TestSuite\TestCase;

/**
 * Admins\Model\Table\EmailTemplatesTable Test Case
 */
class EmailTemplatesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Admins\Model\Table\EmailTemplatesTable
     */
    protected $EmailTemplates;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.Admins.EmailTemplates',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('EmailTemplates') ? [] : ['className' => EmailTemplatesTable::class];
        $this->EmailTemplates = $this->getTableLocator()->get('EmailTemplates', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->EmailTemplates);

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
}
