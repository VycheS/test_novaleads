<?php
class App
{
    function __construct()
    {
        echo "start App";
    }

    public function start($url)
    {
        $html = file_get_contents($url);
        echo '<br>'. parse($html, '<div class="bg coupon-row"', '</div>');
    }
}