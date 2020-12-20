<?php

namespace App\Controller;

use App\Controller\AppController;

class TopicsController extends AppController
{
  public function initialize()
  {

    parent::initialize();
    $this->loadComponent('RequestHandler');
  }

  public function index()
  {
    $data = $this->_measureMilliSec(function () {
      return $this->Topics->find('all');
    });
    $topics = $data['result'];
    $milliSec = $data['milliSec'];

    $this->set([
      'topics' => $topics,
      'milliSec' => $milliSec,
      '_serialize' => ['topics', 'milliSec']
    ]);
  }

  private function _measureMilliSec(callable $callback): array
  {
    $timeStartMicroSec = microtime(true);
    $result = $callback();
    $timeEndMicroSec = microtime(true);

    $timeLapseMicroSec = $timeEndMicroSec - $timeStartMicroSec;
    $timeLapseMilliSec = $timeLapseMicroSec * 1000;
    $timeLapseMilliSecRounded = round($timeLapseMilliSec, 4);

    return [
      'milliSec' => $timeLapseMilliSecRounded,
      'result' => $result,
    ];
  }
}
