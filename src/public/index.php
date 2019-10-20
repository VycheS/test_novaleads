<?php
require_once '../vendor/autoload.php';
// require_once dirname(__DIR__) . '/vendor/autoload.php';

use app\App;

$domainName = 'https://www.marathonbet.ru';
$route = '/su/events.htm';
$params = '?id=11';

$app = new App();
$app->start($domainName, $route, $params);
