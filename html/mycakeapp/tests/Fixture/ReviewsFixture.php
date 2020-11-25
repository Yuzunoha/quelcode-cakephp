<?php

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ReviewsFixture
 */
class ReviewsFixture extends TestFixture
{
    public $import = ['table' => 'reviews'];
    // @codingStandardsIgnoreEnd
    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'id' => 1,
                'bidinfo_id' => 1,
                'reviewer_user_id' => 'Lorem ipsum dolor sit amet',
                'reviewee_user_id' => 'Lorem ipsum dolor sit amet',
                'value' => 1,
                'comment' => 'Lorem ipsum dolor sit amet',
                'created' => '2020-11-20 00:14:37',
            ],
        ];
        parent::init();
    }
}
