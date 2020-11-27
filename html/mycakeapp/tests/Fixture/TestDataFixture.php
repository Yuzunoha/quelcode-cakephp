<?php

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TestDataFixture
 */
class TestDataFixture extends TestFixture
{
    public $import = ['table' => 'test_data'];

    public function init()
    {
        $this->records = [
            [
                'id' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'created' => '2020-11-27 11:58:22',
                'modified' => '2020-11-27 11:58:22',
                'is_received' => 1,
                'status' => 1,
            ],
            [
                'id' => 2,
                'name' => 'status(tinyint)の値を2にしてみる→不可能みたい',
                'created' => '2020-11-27 11:58:22',
                'modified' => '2020-11-27 11:58:22',
                'is_received' => 1,
                // 'status' => 2,
                'status' => 0,
            ],
        ];
        parent::init();
    }
}
