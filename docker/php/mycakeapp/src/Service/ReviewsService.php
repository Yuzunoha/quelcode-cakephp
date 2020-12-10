<?php

namespace App\Service;

use App\Model\Entity\Bidinfo;
use App\Model\Table\ReviewsTable;
use Exception;

class ReviewsService
{
  public static function getTargetDataFromBidinfo(int $login_user_id, Bidinfo $bidinfo)
  {
    $seller_id = $bidinfo->biditem->user->id;
    $bidder_id = $bidinfo->user->id;
    if ($login_user_id === $seller_id) {
      /* ログインユーザが出品者である */
      $target_user_id = $bidder_id;
      $target_user_name = $bidinfo->user->username; // 落札者のユーザ名
    } elseif ($login_user_id === $bidder_id) {
      /* ログインユーザが落札者である */
      $target_user_id = $seller_id;
      $target_user_name = $bidinfo->biditem->user->username; // 出品者のユーザ名
    }
    if (!isset($target_user_id) || !isset($target_user_name)) {
      throw new Exception('ログインユーザIDとbidinfoの組み合わせが不整合です');
    }
    return [$target_user_id, $target_user_name];
  }

  public static function getReviewAndFlag(int $login_user_id, int $bidinfo_id, ReviewsTable $reviewsTable)
  {
    $review = $reviewsTable->find('all', ['conditions' => [
      'reviewer_user_id' => $login_user_id,
      'bidinfo_id' => $bidinfo_id
    ]])->first();
    if ($review) {
      /* ログインユーザがレビューしている */
      $isReviewed = true;
    } else {
      /* ログインユーザがレビューしていない */
      $isReviewed = false;
      $review = $reviewsTable->newEntity();
    }
    return [$review, $isReviewed];
  }
}
