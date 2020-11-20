<?php

namespace App\Controller;

use App\Service\ReviewsService;
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
        $login_user_id = $this->Auth->user('id');
        try {
            $bidinfo = $this->Bidinfo->get($bidinfo_id, ['contain' => ['Users', 'Biditems' => 'Users']]);
            list($target_user_id, $target_user_name) = ReviewsService::getTargetDataFromBidinfo($login_user_id, $bidinfo);
        } catch (Exception $e) {
            /* ログインユーザIDとbidinfoの組み合わせが不整合である */
            return $this->redirect(['controller' => 'Auction', 'action' => 'index']);
        }
        list($review, $isReviewed) = ReviewsService::getReviewAndFlag($login_user_id, $bidinfo_id, $this->Reviews);
        if (
            $this->request->isPost() &&
            true === $bidinfo->is_received && // 受け取り済みである
            false === $isReviewed // ログインユーザがレビューしていない
        ) {
            $review->bidinfo_id = $bidinfo_id;
            $review->reviewer_user_id = $login_user_id;
            $review->reviewee_user_id = $target_user_id;
            $review = $this->Reviews->patchEntity($review, $this->request->getData());
            if ($this->Reviews->save($review)) {
                $isReviewed = true;
            }
        }
        $item_name = $bidinfo->biditem->name;
        $this->set(compact('isReviewed', 'review', 'item_name', 'target_user_name'));
    }
}
