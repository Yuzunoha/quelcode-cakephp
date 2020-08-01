<?php

namespace App\Controller;

use App\Controller\AppController;
use \Exception;

class NumController extends AppController
{
    public $autoRender = false;

    public function index()
    {
        $n = new Number("123");

        echo $n->add(1)->sub(2)->mul(3)->div(4); // 91.5
    }
}

class Number
{
    private $n;
    public function numCheck($n)
    {
        if (!is_numeric($n)) {
            throw new Exception("${n}は数値ではありません");
        }
    }
    public function __construct($n)
    {
        $this->numCheck($n);
        $this->n = floatval($n);
    }
    public function __toString()
    {
        return '' . $this->n;
    }
    public function add($n)
    {
        $this->numCheck($n);
        $this->n += floatval($n);
        return $this;
    }
    public function sub($n)
    {
        $this->numCheck($n);
        $this->n -= floatval($n);
        return $this;
    }
    public function mul($n)
    {
        $this->numCheck($n);
        $this->n *= floatval($n);
        return $this;
    }
    public function div($n)
    {
        $this->numCheck($n);
        if ($n == 0) { // 暗黙の型変換を利用するために等値演算子で比較
            throw new Exception('0除算');
        }
        $this->n /= $n;
        return $this;
    }
}
