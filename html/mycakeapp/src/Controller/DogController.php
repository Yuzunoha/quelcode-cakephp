<?php

namespace App\Controller;

use App\Controller\AppController;
use \Exception;

class DogController extends AppController
{
    public $autoRender = false;

    public function index()
    {
        $犬1 = 犬ビルダー::builder()
            ->名前('コロ')
            ->年齢(8)
            ->犬種('ポメラニアン')
            ->build();

        $犬2 = 犬ビルダー::builder()
            ->名前('はまちゃん')
            ->年齢(5)
            ->犬種('コーギー')
            ->build();

        echo $犬1, $犬2; // コロ(8/ポメラニアン)はまちゃん(5/コーギー)
    }
}

class 犬
{
    protected $名前;
    protected $犬種;
    protected $年齢;
    public function __construct($名前, $犬種, $年齢)
    {
        $コンストラクタを呼び出したクラス = debug_backtrace()[1]['class'];
        if (false === strpos($コンストラクタを呼び出したクラス, '犬ビルダー')) {
            throw new Exception('犬は犬ビルダーからしか生まれないワン');
        }
        $this->名前 = $名前;
        $this->犬種 = $犬種;
        $this->年齢 = $年齢;
    }
    public function __toString()
    {
        return "{$this->名前}({$this->年齢}/{$this->犬種})";
    }
}

class 犬ビルダー
{
    protected $名前;
    protected $犬種;
    protected $年齢;
    public static function builder()
    {
        return new 犬ビルダー;
    }
    public function build()
    {
        if (!$this->名前 || !$this->犬種 || !$this->年齢) {
            throw new Exception('パラメタが足りないワン');
        }
        return new 犬($this->名前, $this->犬種, $this->年齢);
    }
    public function 名前($a)
    {
        $this->名前 = $a;
        return $this;
    }
    public function 犬種($a)
    {
        $this->犬種 = $a;
        return $this;
    }
    public function 年齢($a)
    {
        $this->年齢 = $a;
        return $this;
    }
}
