<?php

namespace App\Test\TestCase\Service;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

use App\Model\Table\BiditemsTable;
use App\Model\Table\BidinfoTable;
use App\Model\Table\ReviewsTable;
use App\Model\Table\UsersTable;
use App\Service\ReviewsService;
use Exception;

class ReviewsServiceTest extends TestCase
{
  use IntegrationTestTrait;

  public $fixtures = ['app.Users', 'app.Biditems', 'app.Reviews'];

  public function setUp()
  {
    $this->loadFixtures('Users', 'Biditems', 'Reviews');
    parent::setUp();
    $this->Users = TableRegistry::getTableLocator()->get('Users', ['className' => UsersTable::class]);
    $this->Biditems = TableRegistry::getTableLocator()->get('Biditems', ['className' => BiditemsTable::class]);
    $this->Bidinfo = TableRegistry::getTableLocator()->get('Bidinfo', ['className' => BidinfoTable::class]);
    $this->Reviews = TableRegistry::getTableLocator()->get('Reviews', ['className' => ReviewsTable::class]);
  }

  public function fixtureBidinfo1()
  {
    $seller = $this->Users->get(1);
    $bidder = $this->Users->get(2);
    $biditem = $this->Biditems->get($seller->id);
    $biditem->user = $seller;

    $bidinfo = $this->Bidinfo->newEntity();
    $bidinfo->biditem_id = $biditem->id;
    $bidinfo->user_id = $bidder->id;
    $bidinfo->user = $bidder;
    $bidinfo->price = 1234;
    $bidinfo->biditem = $biditem;
    return $bidinfo;
  }

  public function testGetTargetDataFromBidinfo1()
  {
    $login_user_id = 1;
    $bidinfo = $this->fixtureBidinfo1();
    list($target_user_id, $target_user_name) = ReviewsService::getTargetDataFromBidinfo($login_user_id, $bidinfo);
    $this->assertEquals($target_user_id, 2);
    $this->assertEquals($target_user_name, '2さん');
  }

  public function testGetTargetDataFromBidinfo2()
  {
    $login_user_id = 2;
    $bidinfo = $this->fixtureBidinfo1();
    list($target_user_id, $target_user_name) = ReviewsService::getTargetDataFromBidinfo($login_user_id, $bidinfo);
    $this->assertEquals($target_user_id, 1);
    $this->assertEquals($target_user_name, '1さん');
  }

  public function testGetTargetDataFromBidinfo3()
  {
    $login_user_id = 3;
    $bidinfo = $this->fixtureBidinfo1();
    try {
      ReviewsService::getTargetDataFromBidinfo($login_user_id, $bidinfo);
    } catch (Exception $e) {
      $this->assertEquals($e instanceof Exception, true);
    }
  }

  public function testFixture1()
  {
    // pr($this->Reviews->find('all')->toArray());
    $this->assertEquals(1, 1);
  }

  public function testFixture2()
  {
    $user1 = $this->Users->get(1);
    // pr($user1);
    $this->assertEquals(1, 1);
  }
}
