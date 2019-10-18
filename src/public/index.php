<?php
require_once dirname(__DIR__) . '/config/init.php';

require_once LIBS . '/parse.php';
require_once LIBS . '/debug.php';
require_once APP . '/App.php';

$domainName = 'https://www.marathonbet.ru';
$route = '/su/events.htm';
$params = '?id=11';

$app = new App();
$app->start($domainName, $route, $params);
