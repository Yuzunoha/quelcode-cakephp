<?php

namespace App\Controller;

use App\Controller\AppController;

class HelloController extends AppController
{
    public function initialize()
    {
        $this->viewBuilder()->setLayout('hello');
    }

    public function index()
    {
        $this->viewBuilder()->setLayout('hello');
    }

    public function form()
    {
        $this->viewBuilder()->autoLayout(false);

        $name = $this->request->data['name'];
        $mail = $this->request->data['mail'];
        $age = $this->request->data['age'];

        $res = 'こんにちは、' . $name . '(' . $age . ') さん。';
        $res .= 'メアドは、' . $mail . 'ですね';

        $values = [
            'title' => 'Result',
            'message' => $res,
        ];
        $this->set($values);
    }
}
