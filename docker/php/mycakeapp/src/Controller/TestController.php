<?php

namespace App\Controller;

use App\Controller\AppController;

class TestController extends AppController
{
    // 初期化処理
    public function initialize()
    {
        parent::initialize();
        // 必要なモデルをすべてロードする
        $this->loadModel('TestData');
    }

    public function test3()
    {
        $entity = $this->TestData->newEntity();
        $entity = $this->TestData->patchEntity($entity, ['name' => 'abc']);
        dd('こんにちは', $entity);
    }

    public function indexget()
    {
        return $this->response->withStringBody(json_encode(['message' => 'Ok', 'data' => '']));
    }

    public function indexpost()
    {
        $entity = $this->TestData->newEntity();
        $entity = $this->TestData->patchEntity($entity, ['name' => 'abc']);
        if ($entity->getErrors()) {
            $response = $this->response->withStatus(400);
            return $response->withStringBody(json_encode(['message' => 'Bad Request', 'data' => $entity->getErrors()]));
        }
        return $this->response->withStringBody(json_encode(['message' => 'Ok', 'data' => '']));
    }
}
