<?php

namespace App\Controller;

use App\Controller\AppController;

class HelloController extends AppController
{
    public function index()
    {
        $this->viewBuilder()->autoLayout(false);
        $values = [
            'title' => 'Hello!',
            'message' => 'This is message!',
        ];
        $this->set($values);
    }
}
