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
            $bidinfo = $this->Bidinfo->get($bidinfo_id, ['contain' => ['Users', 'Biditems' => 'Users']]);
        } catch (Exception $e) {
            return $this->redirect(['controller' => 'Auction', 'action' => 'index']);
        }
        $login_id = $this->Auth->user()['id'];
        $seller_id = $bidinfo->biditem->user_id;
        $bidder_id = $bidinfo->user_id;
        if ($login_id === $bidder_id) {
            /* ログインユーザが落札者である */
            $target_user_id = $seller_id;
            $target_user_name = $bidinfo->biditem->user->username; // 出品者のユーザ名
        } elseif ($login_id === $seller_id) {
            /* ログインユーザが出品者である */
            $target_user_id = $bidder_id;
            $target_user_name = $bidinfo->user->username; // 落札者のユーザ名
        } else {
            /* ログインユーザが出品者でも落札者でもない */
            return $this->redirect(['controller' => 'Auction', 'action' => 'index']);
        }
        $review = $this->Reviews->find('all', ['conditions' => [
            'reviewer_user_id' => $login_id,
            'bidinfo_id' => $bidinfo_id
        ]])->first();
        if ($review) {
            /* ログインユーザがレビューしている */
            $isReviewed = true;
        } else {
            /* ログインユーザがレビューしていない */
            $isReviewed = false;
            $review = $this->Reviews->newEntity();
        }
        if (
            $this->request->isPost() &&
            true === $bidinfo->is_received && // 受け取り済みである
            false === $isReviewed // ログインユーザがレビューしていない
        ) {
            $review->bidinfo_id = $bidinfo_id;
            $review->reviewer_user_id = $login_id;
            $review->reviewee_user_id = $target_user_id;
            $review = $this->Reviews->patchEntity($review, $this->request->getData());
            if ($this->Reviews->save($review)) {
                $isReviewed = true;
            } else {
            }
        }
        $item_name = $bidinfo->biditem->name;
        $this->set(compact('isReviewed', 'review', 'item_name', 'target_user_name'));
    }
}
