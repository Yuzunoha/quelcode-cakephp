<?php

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TestDataTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TestDataTable Test Case
 */
class TestDataTableTest extends TestCase
{
    public $TestData;

    public $fixtures = [
        'app.TestData',
    ];

    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('TestData') ? [] : ['className' => TestDataTable::class];
        $this->TestData = TableRegistry::getTableLocator()->get('TestData', $config);
    }

    public function testFixture1()
    {
        $testData = $this->TestData->find('all')->toArray();
        foreach ($testData as $record) {
            var_dump($record->toArray());
        }
        $this->assertEquals(1, 1);
    }
}
