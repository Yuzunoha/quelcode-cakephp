<?php

namespace App\Controller;

use App\Controller\AppController;
use App\Service\MeasureService;

class SleepController extends AppController
{
  public function initialize()
  {
    parent::initialize();
    $this->loadComponent('RequestHandler');
  }

  public function sleepms10()
  {
    $ms = 10;
    $data = $this->_measureMilliSecWrap($ms);
    return $this->response->withStringBody(json_encode(['message' => 'Ok', 'data' => $data]));
  }

  public function sleepms20()
  {
    $ms = 20;
    $data = $this->_measureMilliSecWrap($ms);
    return $this->response->withStringBody(json_encode(['message' => 'Ok', 'data' => $data]));
  }

  public function sleepms()
  {
    $ms = $this->request->getParam('ms');
    $data = $this->_measureMilliSecWrap($ms);
    return $this->response->withStringBody(json_encode(['message' => 'Ok', 'data' => $data]));
  }

  private function _measureMilliSecWrap(int $ms): array
  {
    $data = MeasureService::measureMilliSec(function () use ($ms) {
      usleep($ms * 1000); // $ms ミリ秒スリープする
      return "Waited for ${ms} ms";
    });
    return $data;
  }
}
