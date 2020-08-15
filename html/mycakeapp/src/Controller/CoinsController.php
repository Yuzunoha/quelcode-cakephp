<?php

namespace App\Controller;

use App\Controller\AppController;

class CoinsController extends AppController
{
  public $autoRender = false;

  public function index()
  {
    $tester = new Tester;
    $tester->testAndDisp();
  }
}

class Tester
{
  public function testAndDisp($times = 10000)
  {
    $result = $this->test($times);
    $msg = $result ? '成功' : '失敗';
    echo $times . ' 回のテスト : ' . $msg . '<br>';
  }
  public function test($times)
  {
    for ($i = 0; $i < $times; $i++) {
      if (false === $this->testOneTime()) {
        return false;
      }
    }
    return true;
  }
  private function testOneTime()
  {
    $solver = new Solver;
    $scales = new Scales;
    $coins = Coin::createCoinsForProbrem();

    $result = $solver->solve($scales, $coins);
    $resultCoin = $result[0];
    $resultLabel = $result[1];

    if (($resultCoin->getWeight() < Coin::$weightBasic) && ($resultLabel === '軽い')) {
      return true;
    }
    if ((Coin::$weightBasic < $resultCoin->getWeight()) && ($resultLabel === '重い')) {
      return true;
    }
    return false;
  }
}

class Solver
{
  public function solve($scales, $coins)
  {
    // 任意の4対4で測る(1回目)
    $result1 = $scales->scale(
      $this->pick($coins, 0, 1, 2, 3),
      $this->pick($coins, 4, 5, 6, 7)
    );
    // 1. 傾いた時、重い側をabcd、軽い側をefghとし、abe対cdfで測る(2回目)
    if ($result1 !== 0) {
      if ($result1 === 1) {
        $a = $coins[0];
        $b = $coins[1];
        $c = $coins[2];
        $d = $coins[3];
        $e = $coins[4];
        $f = $coins[5];
        $g = $coins[6];
        $h = $coins[7];
      } else {
        $a = $coins[4];
        $b = $coins[5];
        $c = $coins[6];
        $d = $coins[7];
        $e = $coins[0];
        $f = $coins[1];
        $g = $coins[2];
        $h = $coins[3];
      }
      $result2 = $scales->scale(
        [$a, $b, $e],
        [$c, $d, $f]
      );
      // 1-1. abe>cdfのとき、aとbのどちらかが重いもしくはfが軽いと分かるので、a対bで測る(3回目)
      // 1-1-1. a>bのとき、aが重いコイン
      // 1-1-2. a<bのとき、bが重いコイン
      // 1-1-3. a=bのとき、fが軽いコイン
      if ($result2 === 1) {
        $result3 = $scales->scale([$a], [$b]);
        switch ($result3) {
          case 1:
            return [$a, '重い'];
          case -1:
            return [$b, '重い'];
          case 0:
            return [$f, '軽い'];
        }
      }
      // 1-2. abe<cdfのとき、cとdのどちらかが軽いもしくはeが軽いと分かるので、c対dで測る(3回目)
      // 1-2-1. c>dのとき、cが重いコイン
      // 1-2-2. c<dのとき、dが重いコイン
      // 1-2-3. c=dのとき、eが軽いコイン
      else if ($result2 === -1) {
        $result3 = $scales->scale([$c], [$d]);
        switch ($result3) {
          case 1:
            return [$c, '重い'];
          case -1:
            return [$d, '重い'];
          case 0:
            return [$e, '軽い'];
        }
      }
      // 1-3. abe=cdfのとき、gとhのどちらかが軽いと分かるので、g対hで測る(3回目)
      // 1-3-1. g>hのとき、hが軽いコイン
      // 1-3-2. g<hのとき、gが軽いコイン
      else {
        $result3 = $scales->scale([$g], [$h]);
        switch ($result3) {
          case 1:
            return [$h, '軽い'];
          case -1:
            return [$g, '軽い'];
        }
      }
    }
    // 2. 釣り合った時、測った8枚をそれぞれo(重さが均一なコイン)、測らなかった4枚をijklとし、ij対koで測る(2回目)
    else {
      $o = $coins[0];
      $i = $coins[8];
      $j = $coins[9];
      $k = $coins[10];
      $l = $coins[11];
      $result2 = $scales->scale(
        [$i, $j],
        [$k, $o]
      );
      // 2-1. ij>koのとき、iとjのどちらかが重いもしくはkが軽いと分かるので、i対jで測る(3回目)
      // 2-1-1. i>jのとき、iが重いコイン
      // 2-1-2. i<jのとき、jが重いコイン
      // 2-1-3. i=jのとき、kが軽いコイン
      if ($result2 === 1) {
        $result3 = $scales->scale([$i], [$j]);
        switch ($result3) {
          case 1:
            return [$i, '重い'];
          case -1:
            return [$j, '重い'];
          case 0:
            return [$k, '軽い'];
        }
      }
      // 2-2. ij<koのとき、iとjのどちらかが軽いもしくはkが重いと分かるので、i対jで測る(3回目)
      // 2-2-1. i>jのとき、jが軽いコイン
      // 2-2-2. i<jのとき、iが軽いコイン
      // 2-2-3. i=jのとき、kが重いコイン
      else if ($result2 === -1) {
        $result3 = $scales->scale([$i], [$j]);
        switch ($result3) {
          case 1:
            return [$j, '軽い'];
          case -1:
            return [$i, '軽い'];
          case 0:
            return [$k, '重い'];
        }
      }
      // 2-3. ij=koのとき、lが重いもしくは軽いと分かるので、l対oで測る(3回目)
      // 2-3-1. l>oのとき、lが重いコイン
      // 2-3-2. l<oのとき、lが軽いコイン
      else {
        $result3 = $scales->scale([$l], [$o]);
        switch ($result3) {
          case 1:
            return [$l, '重い'];
          case -1:
            return [$l, '軽い'];
        }
      }
    }
  }
  private function pick($coins, ...$idxes)
  {
    $a = [];
    foreach ($idxes as $idx) {
      $a[] = $coins[$idx];
    }
    return $a;
  }
}

class Scales
{
  private $count = 0;
  private function countUp()
  {
    $this->count++;
  }
  public function getCount()
  {
    return $this->count;
  }
  public function scale($coinsA, $coinsB)
  {
    $this->countUp();
    $totalWeightA = Coin::getTotalWeightOfCoins($coinsA);
    $totalWeightB = Coin::getTotalWeightOfCoins($coinsB);
    return ($totalWeightA <=> $totalWeightB);
  }
}

class Coin
{
  protected $weight;
  public function __construct($weight)
  {
    $this->weight = $weight;
  }
  public function getWeight()
  {
    return $this->weight;
  }

  public static $weightBasic = 50;
  public static function createCoinsForProbrem()
  {
    $num = 12;
    $weightBasic = self::$weightBasic;
    $randomOffset = (random_int(0, 1) === 0) ? -1 : 1;
    $weightIrregular = $weightBasic + $randomOffset;
    $irregularIdx = random_int(0, $num - 1);
    $coins = [];
    for ($i = 0; $i < $num; $i++) {
      $weight = ($i === $irregularIdx) ? $weightIrregular : $weightBasic;
      $coins[] = new Coin($weight);
    }
    return $coins;
  }
  public static function getTotalWeightOfCoins($coins)
  {
    $totalWeight = 0;
    foreach ($coins as $coin) {
      $totalWeight += $coin->getWeight();
    }
    return $totalWeight;
  }
}
