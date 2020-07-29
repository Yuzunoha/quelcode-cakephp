<?php

namespace App\Controller;

use App\Controller\AppController;

class HelloController extends AppController
{
    public function index()
    {
        $data['msg'] = 'こんにちは';
        $this->set('data', $data);
    }
}
