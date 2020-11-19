<?php

namespace App\Controller;

use Exception;

class ReviewsController extends AuctionBaseController
{
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

    public function view($user_id = null)
    {
        $reviews = $this->paginate($this->Reviews->find('all', [
            'conditions' => ['reviewee_user_id' => $user_id],
            'order' => ['created' => 'desc']
        ]));

        $this->set(compact('reviews'));
    }

    public function add($bidinfo_id = null)
    {
        try {
            $bidinfo = $this->Bidinfo->get($bidinfo_id, ['contain' => ['Biditems']]);
        } catch (Exception $e) {
            return $this->redirect(['controller' => 'Auction', 'action' => 'index']);
        }

        $seller_id = $bidinfo->biditem->user_id;
        $bidder_id = $bidinfo->user_id;
        $login_id = $this->Auth->user()['id'];

        if ($login_id !== $seller_id && $login_id !== $bidder_id) {
            return $this->redirect(['controller' => 'Auction', 'action' => 'index']);
        }

        $review = $this->Reviews->newEntity();
        $this->set(compact('review'));
    }
}
