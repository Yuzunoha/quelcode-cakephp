<?php

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ReviewsFixture
 */
class ReviewsFixture extends TestFixture
{
    public $import = ['table' => 'reviews'];

    public function init()
    {
        $this->records = [
            [
                'id' => 1,
                'bidinfo_id' => 1,
                'reviewer_user_id' => 1,
                'reviewee_user_id' => 2,
                'value' => 3,
                'comment' => 'user1からuser2への評価は3です',
                'created' => '2020-11-25 17:02:00',
            ],
            [
                'id' => 2,
                'bidinfo_id' => 1,
                'reviewer_user_id' => 2,
                'reviewee_user_id' => 1,
                'value' => 4,
                'comment' => 'user2からuser1への評価は4です',
                'created' => '2020-11-25 18:03:00',
            ],
        ];
        parent::init();
    }
}
