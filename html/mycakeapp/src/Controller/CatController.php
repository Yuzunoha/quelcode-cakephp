<?php

namespace App\Controller;

use App\Controller\AppController;
use \Exception;

class CatController extends AppController
{
    public $autoRender = false;

    public function index()
    {
        $猫1 = 猫ビルダー::builder()
            ->年齢(7)
            ->名前('クロちゃん')
            ->毛の色('黒')
            ->build();

        $猫2 = 猫ビルダー::builder()
            ->名前('シロ子')
            ->毛の色('白')
            ->年齢(8)
            ->build();

        echo $猫1, $猫2;
    }
}

class 猫
{
    protected $毛の色;
    protected $年齢;
    protected $名前;
    public function __construct($毛の色, $年齢, $名前)
    {
        $コンストラクタを呼び出したクラス = debug_backtrace()[1]['class'];
        if (false === strpos($コンストラクタを呼び出したクラス, '猫ビルダー')) {
            throw new Exception('猫は猫ビルダーからしか生まれないニャ');
        }
        $this->毛の色 = $毛の色;
        $this->年齢 = $年齢;
        $this->名前 = $名前;
    }
    public function __toString()
    {
        return "{$this->名前}({$this->年齢}/{$this->毛の色})";
    }
}

class 猫ビルダー
{
    protected $毛の色;
    protected $年齢;
    protected $名前;
    public static function builder()
    {
        return new 猫ビルダー;
    }
    public function build()
    {
        if (!$this->毛の色 || !$this->年齢 || !$this->名前) {
            throw new Exception('何らかのパラメタが足りないニャー');
        }
        return new 猫($this->毛の色, $this->年齢, $this->名前);
    }
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
}
