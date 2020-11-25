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

  public $fixtures = ['app.Articles'];

  public function setUp()
  {
    parent::setUp();
    $this->Users = TableRegistry::getTableLocator()->get('Users', ['className' => UsersTable::class]);
    $this->Biditems = TableRegistry::getTableLocator()->get('Biditems', ['className' => BiditemsTable::class]);
    $this->Bidinfo = TableRegistry::getTableLocator()->get('Bidinfo', ['className' => BidinfoTable::class]);
    $this->Reviews = TableRegistry::getTableLocator()->get('Reviews', ['className' => ReviewsTable::class]);
  }

  public function fixtureBidinfo1()
  {
    $user1 = $this->Users->newEntity([
      "username" => "1さん",
      "password" => "pass1",
      "role" => "user"
    ]);
    $user1->id = 1;
    $user2 = $this->Users->newEntity([
      "username" => "2さん",
      "password" => "pass2",
      "role" => "user"
    ]);
    $user2->id = 2;
    $biditem = $this->Biditems->newEntity([
      "user_id" => "1",
      "name" => "1さんの商品",
      "description" => "1さんの商品でーす",
      "finished" => "0",
      "endtime" => [
        "year" => "2020",
        "month" => "11",
        "day" => "20",
        "hour" => "17",
        "minute" => "02"
      ],
      "image_name" => "1.JPG"
    ]);
    $biditem->user = $user1;

    $bidinfo = $this->Bidinfo->newEntity();
    $bidinfo->biditem_id = 1;
    $bidinfo->user_id = 2;
    $bidinfo->user = $user2;
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
    $this->loadFixtures('Articles');
    $this->assertEquals(1, 1);
  }
}
