<?php

namespace App\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;

/**
 * [実行コマンド(Linux)]
 * vendor/bin/phpunit tests/TestCase/Controller/TestControllerTest.php
 */
class TestControllerTest extends IntegrationTestCase
{
    /**
     * TestController.phpのindexgetメソッド
     */
    public function testindexget()
    {
        $this->get('/test1');
        $this->assertResponseCode(200);
        $this->assertEquals('Ok', json_decode($this->_response->getBody(), true)['message']);
        $this->assertEmpty(json_decode($this->_response->getBody(), true)['data']);
    }

    /**
     * TestController.phpのindexpostメソッド
     */
    public function testindexpost()
    {
        // この2つがないと403エラーになる
        $this->cookie("csrfToken", "test-token");
        $this->_request['headers'] = ['X-CSRF-Token' => 'test-token'];

        $this->post('/test2', ["name" => "テスト太郎"]);
        $this->assertResponseCode(200);
        $this->assertEquals('Ok', json_decode($this->_response->getBody(), true)['message']);
        $this->assertEmpty(json_decode($this->_response->getBody(), true)['data']);
    }
}
