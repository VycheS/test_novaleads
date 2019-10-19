<?php
class App
{
    private $matches;
    function __construct()
    {
        //echo "start App";
    }

    public function start(string $domainName, string $route, string $params)
    {
        $html = file_get_contents($domainName . $route . $params . '&page=0&pageAction=getPage');
        $resultAll = parse($html, '<div class=\"bg coupon-row\"', '<table class=\"coupon-row-item\">', true, true);
        //debug($resultAll);
        $html = file_get_contents($domainName . $route . $params . '&page=1&pageAction=getPage');
        $resultOne = parse($html, '<div class=\"bg coupon-row\"', '<table class=\"coupon-row-item\">', true, true);
        $resultAll = array_merge($resultAll, $resultOne);




        foreach ($resultAll as $cell) {
            $key = parse($cell, 'data-event-name=\"', '\"');
            $var = parse($cell, 'data-event-path=\"', '\">');
            $this->matches[$key] = $var;
        }
        debug($this->matches);
    }
}