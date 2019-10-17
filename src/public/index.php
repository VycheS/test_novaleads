<?php
require_once dirname(__DIR__) . '/config/init.php';

require_once LIBS . '/parse.php';
require_once LIBS . '/debug.php';
require_once APP . '/App.php';

$app = new App();
$app->start('https://www.marathonbet.ru/su/events.htm?id=11');
