<?php

namespace App\Controller;

use App\Controller\AppController;

class CoinsController extends AppController
{
  public $autoRender = false;

  public function index()
  {
    echo '<pre>';
    $coins = Coin::createCoinsForProbrem();
    foreach ($coins as $idx => $coin) {
      echo $idx . ' ... ' . $coin->getWeight() . '<br>';
    }
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
  public static function createCoinsForProbrem()
  {
    $num = 12;
    $weightBasic = 50;
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
}
