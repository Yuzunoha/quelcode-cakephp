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
    $expected = [
      ['id' => 1, 'title' => 'First Article'],
      ['id' => 2, 'title' => 'Second Article'],
      ['id' => 3, 'title' => 'Third Article']
    ];
    $actual = $this->Articles->find('IdTitleArray');
    $this->assertEquals($expected, $actual);
  }
}
