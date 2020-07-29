<?php

namespace App\Controller;

use App\Controller\AppController;

class HelloController extends AppController
{
    public function index()
    {
        $data['name'] = $this->request->query['name'];
        $data['pass'] = $this->request->query['pass'];
        $data['msg'] = 'こんにちは';
        $this->set('data', $data);
    }
}
