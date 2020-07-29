<?php

namespace App\Controller;

use App\Controller\AppController;

class HelloController extends AppController
{
    public function index()
    {
        $this->viewBuilder()->autoLayout(false);
        $this->set('title', 'Hello!');
        $this->set('message', 'This is message!');
    }
}
