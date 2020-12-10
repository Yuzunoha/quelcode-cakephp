<?php

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 */
class UsersFixture extends TestFixture
{
    public $import = ['table' => 'users'];
    public function init()
    {
        $this->records = [
            [
                "id" => 1,
                "username" => "1さん",
                "password" => "pass1",
                "role" => "user"
            ],
            [
                "id" => 2,
                "username" => "2さん",
                "password" => "pass2",
                "role" => "user"
            ]
        ];
        parent::init();
    }
}
