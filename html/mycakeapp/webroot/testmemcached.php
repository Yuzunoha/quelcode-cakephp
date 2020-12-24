<?php

$mc = new Memcached();
$mc->addServer("memcached", 11211);
$mc->set("test1", "hoge");
var_dump($mc->get('test1'));
