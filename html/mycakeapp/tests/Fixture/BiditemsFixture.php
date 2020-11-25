<?php

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * BiditemsFixture
 */
class BiditemsFixture extends TestFixture
{
    public $import = ['table' => 'biditems'];

    public function init()
    {
        $this->records = [
            [
                "user_id" => "1",
                "name" => "1さんの商品",
                "description" => "1さんの商品でーす",
                "finished" => "0",
                "endtime" => '2020-11-20 17:02:00',
                "image_name" => "1.JPG",
                "created" => '2020-11-19 17:02:00'
            ],
        ];
        parent::init();
    }
}
