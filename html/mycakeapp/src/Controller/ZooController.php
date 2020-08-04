<?php

namespace App\Controller;

use App\Controller\AppController;

class ZooController extends AppController
{
  public $autoRender = false;

  public function index()
  {
    (new Cat(5))->cry()->move();
    (new Bird(7))->move()->cry();
  }
}

interface Cryable
{
  public function cry();
}

interface Movable
{
  public function move();
}

trait MoveGround
{
  public function move()
  {
    echo 'トコトコ' . PHP_EOL;
    return $this;
  }
}

trait MoveAir
{
  public function move()
  {
    echo 'ヒュー' . PHP_EOL;
    return $this;
  }
}

abstract class Animal implements Cryable, Movable
{
  protected $age;
  public function __construct($age)
  {
    $this->age = $age;
  }
}

class Cat extends Animal
{
  use MoveGround;
  public function cry()
  {
    echo "ニャー({$this->age})" . PHP_EOL;
    return $this;
  }
}

class Bird extends Animal
{
  use MoveAir;
  public function cry()
  {
    echo "鳥です({$this->age})" . PHP_EOL;
    return $this;
  }
}
