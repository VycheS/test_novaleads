<?php

namespace app;


$cookiefile = dirname(__DIR__) . '/tmp/cookies.txt';

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

        for ($i = 1; $i <= 1; $i++) {
            $query = $page . $i . $action;
            $html .= file_get_contents_curl($domainName . $route . $params . $query);
            $resultOne = parse($html, 'bg coupon-row\"', '<table class=', true, true);
            $resultAll += $resultOne;
        }



        foreach ($resultAll as $cell) {
            $key = parse($cell, 'data-event-name=\"', '\"');
            $var = parse($cell, 'data-event-path=\"', '\">');
            $this->matches[] = array($key, $domainName . '/su/betting/' . $var);
        }
        //debug($this->matches);

        $this->query($this->matches[0][1], dirname(__DIR__) . '/tmp/cookies.txt');
        //file_get_contents_curl($this->matches[0][1]);
    }

    private function query($url, $cookiefile, $referer = 'https://www.google.ru/')
    {
        echo $url;
        //GET-------------------------------------------------------------
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_REFERER, $referer);

        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);

        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:69.0) Gecko/20100101 Firefox/69.0');
        
        curl_exec($ch);
        
        //GET/-------------------------------------------------------------
        
        curl_setopt($ch, CURLOPT_URL, 'https://www.marathonbet.ru/su/react/preferences/couponShortcutMenu');
        

        $data = array([
            "eventID" => (int)substr($url, -7),
            "menuLinkId" => "10"
        ]);

        $data_json = json_encode($data);
        
        curl_setopt($ch, CURLOPT_PUT, true);
        //curl_setopt($ch, CURLOPT_POST, true);

        // curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT /su/react/preferences/couponShortcutMenu HTTP/1.1');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);

        $header = [
            
            'Content-Type: application/json',
            'Content-Length:' . strlen($data_json)

        ];
        echo '<br>'.'<h3>'.strlen($data_json).'</h3>';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

        //curl_setopt($ch, CURLOPT_REFERER, $url);
        
        $result = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        echo '<br>'.'<h1>'.$http_code.'</h1>';
        echo $result;
        curl_close($ch);
        
    }
}
