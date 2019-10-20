<?php
namespace app;
use libs\functions\file_get_contents_curl;
class App
{
    private $matches;
    function __construct()
    {
        //echo "start App";
    }

    public function start(string $domainName, string $route, string $params)
    {
        $page  = '&page=';
        $action = '&pageAction=getPage';
        $html = file_get_contents_curl($domainName . $route . $params . $page . 0 . $action);
        $resultAll = parse($html, 'bg coupon-row\"', '<table class=', true, true);
        //debug($resultAll);
        
        for ($i = 1; $i <= 3; $i++) {
            $query = $page . $i . $action;
            $html .= file_get_contents_curl($domainName . $route . $params . $query);
            $resultOne = parse($html, 'bg coupon-row\"', '<table class=', true, true);
            $resultAll += $resultOne;
        }



        foreach ($resultAll as $cell) {
            $key = parse($cell, 'data-event-name=\"', '\"');
            $var = parse($cell, 'data-event-path=\"', '\">');
            $this->matches[$key] = $domainName . '/su/betting/' . $var;
        }
        debug($this->matches);
    }

    private function query()
    {
        
    }
}