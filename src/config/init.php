<?php

define("DEBUG", 1);
if(DEBUG == 1){
    error_reporting(E_ALL);
} else {
    error_reporting(0);
}

define("ROOT", dirname(__DIR__));
define("WWW", ROOT . '/public');
define("APP", ROOT . '/app');
define("LIBS", ROOT . '/vendor/libs');
define("CONF", ROOT . '/config');

$app_path = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['PHP_SELF']}";

$app_path = preg_replace("#[^/]+$#", '', $app_path);

$app_path = str_replace('/public/', '', $app_path);

define("PATH", $app_path);

require_once ROOT . '/vendor/autoload.php';