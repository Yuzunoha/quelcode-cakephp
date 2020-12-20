<?php

namespace App\Service;

class MeasureService
{
  static public function measureMilliSec(callable $callback): array
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
