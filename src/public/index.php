<?php
require_once dirname(__DIR__) . '/config/init.php';

require_once LIBS . '/parser.php';
echo "hello world";



$string = file_get_contents('https://www.marathonbet.ru/su/events.htm?id=11');
echo Parse($string, '<div class="columns clearfix">', '</div>');
echo '<br>'.Parse($string, '<title>', '</title>');
