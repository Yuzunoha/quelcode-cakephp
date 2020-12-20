<?php

namespace App\Controller;

use App\Controller\AppController;
use App\Service\MeasureService;

class TopicsController extends AppController
{
  public function initialize()
  {

    parent::initialize();
    $this->loadComponent('RequestHandler');
  }

  public function index()
  {
    $data = MeasureService::measureMilliSec(function () {
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
}
