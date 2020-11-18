<?php

namespace App\Controller;

use Exception;

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

    public function index($bidinfo_id = null)
    {
        try {
            $bidinfo = $this->Bidinfo->get($bidinfo_id, ['contain' => ['Biditems']]);
        } catch (Exception $e) {
            return $this->redirect(['controller' => 'Auction', 'action' => 'index']);
        }

        $seller_id = $bidinfo->biditem->user_id;
        $bidder_id = $bidinfo->user_id;
        $login_id = $this->Auth->user()['id'];

        if ($login_id === $seller_id) {
            return $this->redirect(['action' => 'send', $bidinfo_id]);
        }
        if ($login_id === $bidder_id) {
            if ($bidinfo->bidder_name) {
                return $this->redirect(['action' => 'receive', $bidinfo_id]);
            }
            return $this->redirect(['action' => 'address', $bidinfo_id]);
        }
        return $this->redirect(['controller' => 'Auction', 'action' => 'index']);
    }

    public function address($bidinfo_id = null)
    {
        try {
            $bidinfo = $this->Bidinfo->get($bidinfo_id, ['contain' => ['Biditems']]);
        } catch (Exception $e) {
            return $this->redirect(['controller' => 'Auction', 'action' => 'index']);
        }

        $bidder_id = $bidinfo->user_id;
        $login_id = $this->Auth->user()['id'];

        if ($login_id !== $bidder_id) {
            return $this->redirect(['controller' => 'Auction', 'action' => 'index']);
        }

        if ($this->request->isPut()) {
            $requestData = $this->request->getData();
            dd($requestData);
        }

        $this->set(compact('bidinfo'));
    }

    public function send($bidinfo_id = null)
    {
        return $this->redirect(['controller' => 'Auction', 'action' => 'index']);
    }

    public function receive($bidinfo_id = null)
    {
        return $this->redirect(['controller' => 'Auction', 'action' => 'index']);
    }
}
