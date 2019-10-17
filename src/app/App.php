<?php
class App
{
    function __construct()
    {
        //echo "start App";
    }

    public function start($url)
    {
        $html = file_get_contents($url);
        $result = parse($html, '<div class="bg coupon-row"', '<table class="coupon-row-item">', true, true);
        debug($result);
    }
}