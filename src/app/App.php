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

        $this->put_query($this->matches[0][1], dirname(__DIR__) . '/tmp/cookies.txt');
    }


    private function put_query($url, $cookiefile, $data = null, $referer = 'https://www.google.ru/')
    {
        echo $url;
        //$data_json = '[{".eventID":'.substr($url, -7).',"menuLinkId":"10"}]';

        $data = array([
            'eventID' => substr($url, -7),
            'menuLinkId' => '10'
        ]);

        $data_json = json_encode($data);

        $headers = [
            'Accept: application/json, text/javascript, */*; q=0.01',
            'Accept-Encoding: gzip, deflate, br',
            'Accept-Language: ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7',
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_json),
            'Host: www.marathonbet.ru',
            'Origin: https://www.marathonbet.ru',
            'Sec-Fetch-Mode: cors',
            'Sec-Fetch-Site: same-origin',
            'X-Requested-With: XMLHttpRequest'

        ];

        $tmp_ch = curl_init();
        curl_setopt($tmp_ch, CURLOPT_REFERER, $referer);
        curl_setopt($tmp_ch, CURLOPT_COOKIEJAR, $cookiefile);
        curl_setopt($tmp_ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:69.0) Gecko/20100101 Firefox/69.0');
        curl_setopt($tmp_ch, CURLOPT_URL, $url);
        curl_setopt($tmp_ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($tmp_ch);
        curl_close($tmp_ch);
        //---------------------------------------------------------------------------------------
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.marathonbet.ru/su/react/preferences/couponShortcutMenu');
        //curl_setopt($ch, CURLOPT_TIMEOUT, 10);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:69.0) Gecko/20100101 Firefox/69.0');

        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
        
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_REFERER, $url);

        curl_setopt($ch, CURLOPT_PUT, true);
        curl_setopt($ch, CURLOPT_POST, true);

        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);

        $result = curl_exec($ch);
        
        curl_close($ch);

        echo $result;
    }
}
