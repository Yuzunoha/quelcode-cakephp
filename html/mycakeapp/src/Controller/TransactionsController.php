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
            /* ログインユーザが落札者でない */
            return $this->redirect(['controller' => 'Auction', 'action' => 'index']);
        }

        if ($bidinfo->bidder_address) {
            /* 住所が既に登録されている */
            return $this->redirect(['action' => 'receive', $bidinfo_id]);
        }

        if ($this->request->isPut()) {
            $bidinfo = $this->Bidinfo->patchEntity($bidinfo, $this->request->getData());
            if ($this->Bidinfo->save($bidinfo)) {
                return $this->redirect(['action' => 'receive', $bidinfo_id]);
            }
        }

        $this->set(compact('bidinfo'));
    }

    public function send($bidinfo_id = null)
    {
        try {
            $bidinfo = $this->Bidinfo->get($bidinfo_id, ['contain' => ['Biditems']]);
        } catch (Exception $e) {
            return $this->redirect(['controller' => 'Auction', 'action' => 'index']);
        }

        $seller_id = $bidinfo->biditem->user_id;
        $login_id = $this->Auth->user()['id'];

        if ($login_id !== $seller_id) {
            /* ログインユーザが出品者でない */
            return $this->redirect(['controller' => 'Auction', 'action' => 'index']);
        }

        /* ログインユーザが出品者である */
        if (
            $this->request->isPut() &&
            isset($bidinfo->bidder_address) && // 住所が登録されている
            false === $bidinfo->is_sent // 発送済みボタンが押されていない 
        ) {
            /* putリクエストかつ住所が登録されているかつ発送済みボタンが押されていない */
            $bidinfo = $this->Bidinfo->patchEntity($bidinfo, ['is_sent' => true]);
            $this->Bidinfo->save($bidinfo);
        }

        $this->set(compact('bidinfo'));
    }

    public function receive($bidinfo_id = null)
    {
        try {
            $bidinfo = $this->Bidinfo->get($bidinfo_id, ['contain' => ['Biditems']]);
        } catch (Exception $e) {
            return $this->redirect(['controller' => 'Auction', 'action' => 'index']);
        }

        $bidder_id = $bidinfo->user_id;
        $login_id = $this->Auth->user()['id'];

        if ($login_id !== $bidder_id) {
            /* ログインユーザが落札者でない */
            return $this->redirect(['controller' => 'Auction', 'action' => 'index']);
        }

        /* ログインユーザが落札者である */

        if (
            $this->request->isPut() &&
            true === $bidinfo->is_sent && // 発送済みボタンが押されている
            false === $bidinfo->is_received // 受取り済みボタンが押されていない
        ) {
            /* putリクエストかつ発送済みボタンが押されているかつ受取り済みボタンが押されていない */
            $bidinfo = $this->Bidinfo->patchEntity($bidinfo, ['is_received' => true]);
            $this->Bidinfo->save($bidinfo);
        }

        $this->set(compact('bidinfo'));
    }
}
