<?php

namespace App\Controller;

use App\Controller\AppController;

class CatController extends AppController
{
    public $autoRender = false;

    public function index()
    {
        $うちの猫 = new 猫;
        $うちの猫->名前('みけちゃん')->毛の色('三毛')->年齢(3); // メソッドチェーン
        echo $うちの猫;
    }
}

class 猫
{
    protected $毛の色;
    protected $年齢;
    protected $名前;

    public function 毛の色($a)
    {
        $this->毛の色 = $a;
        return $this;
    }

    public function 年齢($a)
    {
        $this->年齢 = $a;
        return $this;
    }

    public function 名前($a)
    {
        $this->名前 = $a;
        return $this;
    }

    public function __toString()
    {
        return "{$this->名前}({$this->年齢}/{$this->毛の色})";
    }
}
