<?php

require_once(__DIR__ . '/vendor/autoload.php');

spl_autoload_register();

use MVC\Controllers\Controller;
use Predis\Client;

$redis = new Client();

$obj = new Controller('pages.html', $redis);
echo $obj->render();
