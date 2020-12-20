<?php

namespace App\Test\TestCase\Service;

use App\Service\MeasureService;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

class MeasureServiceTest extends TestCase
{
  use IntegrationTestTrait;

  private function _testMeasureMilliSecCommon($ms)
  {
    $data = MeasureService::measureMilliSec(function () use ($ms) {
      usleep($ms * 1000); // マイクロ秒を指定してスリープする
      return "Waited for ${ms} ms";
    });
    $this->assertGreaterThanOrEqual($ms, $data['milliSec']);
    $this->assertLessThan($ms + 1, $data['milliSec']);
    $this->assertEquals("Waited for ${ms} ms", $data['result']);
  }

  public function testMeasureMilliSec_1ミリ秒スリープする()
  {
    $ms = 1;
    $this->_testMeasureMilliSecCommon($ms);
  }

  public function testMeasureMilliSec_10ミリ秒スリープする()
  {
    $ms = 10;
    $this->_testMeasureMilliSecCommon($ms);
  }
}
