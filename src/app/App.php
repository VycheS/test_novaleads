<?php
class App
{
    function __construct()
    {
        echo "start App";
    }

    public function start()
    {
        $string = file_get_contents('https://www.marathonbet.ru/su/events.htm?id=11');
        echo Parse($string, '<div class="columns clearfix">', '</div>');
        echo '<br>' . Parse($string, '<title>', '</title>');
    }
}