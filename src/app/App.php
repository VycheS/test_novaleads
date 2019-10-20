<?php

namespace app;

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

        $this->query2();
    }

    private function query()
    {
        $url = $this->matches[0][1];
        echo $url;
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 10);
        curl_setopt($curl, CURLOPT_POST, 1); // Устанавливаем метод POST
        $data = '[{"eventId":8644937,"menuLinkId":"9"}]';
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $html = curl_exec($curl);
        curl_close($curl);
        echo $html;
    }

    private function query2()
    {
        $url = $this->matches[0][1];
        echo $url;

        $data_string = '[{"eventId":8439955,"menuLinkId":"10"}]';

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, '@'.$data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'PUT /su/react/preferences/couponShortcutMenu HTTP/1.1',
            'Host: www.marathonbet.ru',
            'Connection: keep-alive',
            'Content-Length: 39',
            'Accept: application/json, text/javascript, */*; q=0.01',
            'Origin: https://www.marathonbet.ru',
            //'X-Requested-With: XMLHttpRequest',
            'User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36',
            'Sec-Fetch-Mode: cors',
            'Content-Type: application/json',
            'Sec-Fetch-Site: same-origin',
            'Referer: https://www.marathonbet.ru/su/betting/Football/Clubs.+International/UEFA+Champions+League/Group+Stage/Atletico+Madrid+vs+Bayer+04+Leverkusen+-+8439955',
            //'Accept-Encoding: gzip, deflate, br',
            'Accept-Language: ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7',
            'Cookie: panbet.openeventnameseparately=true; panbet.openadditionalmarketsseparately=false; puid=rBkp8V2px92pVlVnQ+YQAg==; SESSION_KEY=0869255e87c347e4b923377b07e84c37; X-Referer=www.marathonbet.ru; MSESSION_KEY=92564e8bcf2f4f54b9996c5fe7198825; MJSESSIONID=web6~F07A3EE6A08EE5433FBD9B25F2A8FA22; SyncTimeData={"offset":-8,"timestamp":1571591981670}; JSESSIONID=web2~2C090D34B8C172840061BD212BC732E4'
        ));



        $result = curl_exec($ch);
        curl_close($ch);
        echo $result;
    }
}
