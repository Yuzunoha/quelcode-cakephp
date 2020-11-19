<?php

namespace App\Controller;

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
    }
}
