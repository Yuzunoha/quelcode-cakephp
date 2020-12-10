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

  public $fixtures = ['app.Users', 'app.Biditems', 'app.Bidinfo', 'app.Reviews'];

  public function setUp()
  {
    $this->loadFixtures('Users', 'Biditems', 'Bidinfo', 'Reviews');
    parent::setUp();
    $this->Users = TableRegistry::getTableLocator()->get('Users', ['className' => UsersTable::class]);
    $this->Biditems = TableRegistry::getTableLocator()->get('Biditems', ['className' => BiditemsTable::class]);
    $this->Bidinfo = TableRegistry::getTableLocator()->get('Bidinfo', ['className' => BidinfoTable::class]);
    $this->Reviews = TableRegistry::getTableLocator()->get('Reviews', ['className' => ReviewsTable::class]);
  }

  public function getBidinfoByBiditemId($biditem_id)
  {
    $bidinfo = $this->Bidinfo->find('all', [
      'conditions' => ['biditem_id' => $biditem_id],
      'contain' => ['Users', 'Biditems' => 'Users'],
    ])->first();
    return $bidinfo;
  }

  public function testGetTargetDataFromBidinfo1()
  {
    $login_user_id = 1;
    $biditem_id = 1;
    $bidinfo = $this->getBidinfoByBiditemId($biditem_id);
    list($target_user_id, $target_user_name) = ReviewsService::getTargetDataFromBidinfo($login_user_id, $bidinfo);
    $this->assertEquals($target_user_id, 2);
    $this->assertEquals($target_user_name, '2さん');
  }

  public function testGetTargetDataFromBidinfo2()
  {
    $login_user_id = 2;
    $biditem_id = 1;
    $bidinfo = $this->getBidinfoByBiditemId($biditem_id);
    list($target_user_id, $target_user_name) = ReviewsService::getTargetDataFromBidinfo($login_user_id, $bidinfo);
    $this->assertEquals($target_user_id, 1);
    $this->assertEquals($target_user_name, '1さん');
  }

  public function testGetTargetDataFromBidinfo3()
  {
    $login_user_id = 3;
    $biditem_id = 1;
    $bidinfo = $this->getBidinfoByBiditemId($biditem_id);
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

  public function testGetReviewAndFlag1_ログインユーザがレビューしている()
  {
    $login_user_id = 1;
    $bidinfo_id = 1;
    list($review, $isReviewed) = ReviewsService::getReviewAndFlag($login_user_id, $bidinfo_id, $this->Reviews);
    $this->assertEquals($this->Reviews->get(1), $review);
    $this->assertEquals(true, $isReviewed);
  }

  public function testGetReviewAndFlag2_ログインユーザがレビューしていない()
  {
    $login_user_id = -1;
    $bidinfo_id = 1;
    list($review, $isReviewed) = ReviewsService::getReviewAndFlag($login_user_id, $bidinfo_id, $this->Reviews);
    $this->assertEquals($this->Reviews->newEntity(), $review);
    $this->assertEquals(false, $isReviewed);
  }
}
