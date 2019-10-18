<?php
class App
{
    function __construct()
    {
        //echo "start App";
    }

    public function start(string $domainName, string $route, string $params)
    {
        $html = file_get_contents($domainName . $route . $params);
        $result = parse($html, '<div class="bg coupon-row"', '<table class="coupon-row-item">', true, true);
        debug($result);
    }
}