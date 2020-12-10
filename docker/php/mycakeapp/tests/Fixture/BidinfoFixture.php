<?php

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * BidinfoFixture
 */
class BidinfoFixture extends TestFixture
{
    public $import = ['table' => 'bidinfo'];

    public function init()
    {
        $this->records = [
            [
                'id' => 1,
                "biditem_id" => 1,
                "user_id" => 2,
                "price" => 1234,
                'created' => '2020-11-19 17:02:00',
                'modified' => '2020-11-19 17:02:00',
            ],
        ];
        parent::init();
    }
}
