<?php

session_start();

$mc = new Memcached();
$mc->addServer("memcached", 11211);
$mc->set("test1", "hoge");

var_dump($_SESSION);
