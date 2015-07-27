<?php
define('ROOT',__DIR__.'/..');
//define('DS','/');
//initialize ES
require ROOT.'/../vendor/autoload.php';
//Initialize Predis
require ROOT."/../predis/autoload.php";
Predis\Autoloader::register();


?>