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
        $this->set('header', ['subtitle' => 'from Controller with Love♡コントローラから渡したheaderの値']);
        $this->set('footer', ['copyright' => '名無しの権兵衛。コントローラから渡したfooterの値']);
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
