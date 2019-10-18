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
        $html = file_get_contents($domainName . $route . $params);
        $result = parse($html, '<div class="bg coupon-row"', '<table class="coupon-row-item">', true, true);
        //debug($result);
        foreach ($result as $cell) {
            $key = parse($cell, 'data-event-name="', '" data-live');
            $var = parse($cell, 'data-event-path="', '">');
            $this->matches[$key] = $var;
        }
        debug($this->matches);
    }
}