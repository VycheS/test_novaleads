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
        $user_agent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:69.0) Gecko/20100101 Firefox/69.0';
        // //111111111111111111111111111111111111111111111111111111----------------------------
        // $ch = curl_init();
        // curl_setopt($ch, CURLOPT_URL, $url);
        // curl_setopt($ch, CURLOPT_REFERER, $referer);

        // curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);
        // //curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);

        // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        // curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);

        // curl_exec($ch);

        // curl_close($ch);

        $this->put_query($url, $cookiefile);


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_REFERER, $referer);

        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);

        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLINFO_HEADER_OUT, true);

        curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);

        $result = curl_exec($ch);

        curl_close($ch);

        echo $result;
    }

    private function put_query($url, $cookiefile, $referer = 'https://www.google.ru/', $user_agent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:69.0) Gecko/20100101 Firefox/69.0')
    {
        // $ch = curl_init();

        $data = array([
            "eventID" => (int) substr($url, -7),
            "menuLinkId" => "10"
        ]);

        

        $data_json = json_encode($data);

        // echo $data_json;

        $header = [
            'Host: www.marathonbet.ru',
            'Accept: application/json, text/javascript, */*; q=0.01',
            'Accept-Language: ru-RU,ru;q=0.8,en-US;q=0.5,en;q=0.3',
            'Accept-Encoding: gzip, deflate, br',
            'Content-Type: application/json',
            'X-Requested-With: XMLHttpRequest',
            'Connection: keep-alive',
            'Origin: https://www.marathonbet.ru',
            'Pragma: no-cache',
            'Cache-Control: no-cache'
        ];

        $this->put_query_curl($data_json, $cookiefile);

        // $setopt_arr = [
        //     CURLOPT_URL => 'https://www.marathonbet.ru/su/react/preferences/couponShortcutMenu',
        //     CURLOPT_HEADER => true,
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_COOKIEJAR => $cookiefile,
        //     CURLOPT_COOKIEFILE => $cookiefile,
        //     CURLOPT_CUSTOMREQUEST => 'PUT',
        //     CURLOPT_HTTPHEADER => $header,
        //     CURLOPT_POST => true,
        //     CURLOPT_POSTFIELDS => $data_json,
        //     CURLOPT_REFERER => $url,
        //     CURLOPT_USERAGENT => $user_agent,
        //     CURLOPT_SSL_VERIFYPEER => false,
        //     CURLOPT_SSL_VERIFYHOST => false,
        //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //     CURLINFO_HEADER_OUT => true,
        //     CURLOPT_CONNECTTIMEOUT => 10
        // ];

        // curl_setopt_array($ch, $setopt_arr);

        // curl_exec($ch);
        // $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        // echo '<br>' . '<h1>' . $http_code . '</h1>';
        // debug(curl_getinfo($ch, CURLINFO_HEADER_OUT));
        // //echo $result;
        // curl_close($ch);
    }

    private function put_query_curl($query, $cookiefile)
    {

        $header = [
            'Host: www.marathonbet.ru',
            'User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:70.0) Gecko/20100101 Firefox/70.0',
            'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
            'Accept-Language: ru-RU,ru;q=0.8,en-US;q=0.5,en;q=0.3',
            'Accept-Encoding: gzip, deflate, br',
            'Content-Type: application/json',
            'X-Requested-With: XMLHttpRequest',
            'Connection: keep-alive',
            'Origin: https://www.marathonbet.ru',
            'Pragma: no-cache',
            'Cache-Control: no-cache',
            'Upgrade-Insecure-Requests: 1'
        ];
        // Start curl
        $ch = curl_init('https://www.marathonbet.ru/su/react/preferences/couponShortcutMenu');
        // URL for curl
        //$url = "http://localhost/";

        // Clean up string
        $putString = stripslashes($query);
        // Put string into a temporary file
        $putData = tmpfile();
        // Write the string to the temporary file
        fwrite($putData, $putString);
        // Move back to the beginning of the file
        fseek($putData, 0);

        // Headers
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        // Binary transfer i.e. --data-BINARY
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Using a PUT method i.e. -XPUT
        curl_setopt($ch, CURLOPT_PUT, true);
        // Instead of POST fields use these settings
        curl_setopt($ch, CURLOPT_INFILE, $putData);
        curl_setopt($ch, CURLOPT_INFILESIZE, strlen($putString));

        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);

        curl_setopt($ch, CURLINFO_HEADER_OUT, true);

        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);

        curl_exec($ch);
        //echo $output;

        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        echo '<br>' . '<h1>' . $http_code . '</h1>';
        debug(curl_getinfo($ch, CURLINFO_HEADER_OUT));

        // Close the file
        fclose($putData);
        // Stop curl
        curl_close($ch);
    }
}
