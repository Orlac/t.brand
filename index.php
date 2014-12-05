<?php

namespace test;

define('PROJECTROOT', dirname(__FILE__));
require_once('lib/' . __NAMESPACE__ . '/Loader.php');
Loader::init();

$host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost';
S('Config')->set($host);

S('Application')->run();
