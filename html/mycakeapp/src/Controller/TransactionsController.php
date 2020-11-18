<?php

namespace App\Controller;

class TransactionsController extends AuctionBaseController
{
    // デフォルトテーブルを使わない
    public $useTable = false;

    // 初期化処理
    public function initialize()
    {
        parent::initialize();
        // 必要なモデルをすべてロードする
        $this->loadModel('Biditems');
        $this->loadModel('Bidinfo');
        // ログインしているユーザー情報をauthuserに設定する
        $this->set('authuser', $this->Auth->user());
        // レイアウトをauctionに変更する
        $this->viewBuilder()->setLayout('auction');
    }

    public function index()
    {
        return $this->redirect(['controller' => 'Auction', 'action' => 'index']);
    }

    public function address($bidinfo_id = null)
    {
        $bidinfo = $this->Bidinfo->newEntity();
        $this->set(compact('bidinfo'));
    }
}
