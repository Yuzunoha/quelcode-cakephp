<?php

namespace App\Test\TestCase\Service;

use App\Service\ReviewsService;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

class ReviewsServiceTest extends TestCase
{
  use IntegrationTestTrait;

  public function testHello()
  {
    $this->assertEquals('hello', ReviewsService::hello());
  }
}
