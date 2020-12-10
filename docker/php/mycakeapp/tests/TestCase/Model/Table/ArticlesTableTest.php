<?php

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ArticlesTable;
use App\Test\Fixture\ArticlesFixture;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

class ArticlesTableTest extends TestCase
{
  public $fixtures = ['app.Articles'];

  public function setUp()
  {
    parent::setUp();
    $this->Articles = TableRegistry::getTableLocator()->get('Articles');
  }

  public function testFindPublished()
  {
    $query = $this->Articles->find('published');
    $this->assertInstanceOf('Cake\ORM\Query', $query);
    $result = $query->enableHydration(false)->toArray();
    // pr($result);
    $this->assertEquals(1, 1);
  }

  public function testFindIdTitleArray()
  {
    $records = (new ArticlesFixture)->records;
    foreach ($records as $record) {
      $expected[] = [
        'id' => $record['id'],
        'title' => $record['title'],
      ];
    }
    $actual = $this->Articles->find('IdTitleArray');
    $this->assertEquals($expected, $actual);
  }
}
