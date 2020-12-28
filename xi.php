<?php

function xiaomiCountry($imei)
{
    $curl = curl_init();

    curl_setopt_array($curl, [
    CURLOPT_URL => "https://buy.mi.co.id/id/registration",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "imei=" . $imei,
    CURLOPT_HTTPHEADER => [
        "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9",
        "Accept-Encoding: gzip, deflate, br",
        "Accept-Language: id-ID,id;q=0.9,en-US;q=0.8,en;q=0.7",
        "Cache-Control: max-age=0",
        "Connection: keep-alive",
        "Content-Length: 20",
        "Content-Type: application/x-www-form-urlencoded",
        "Cookie: _ot_use_type=1; hasReview=false; _ot_instance_id=9859f37f8baa3398c25a4225cda3063f; _ot_prev_uri_path=https://www.google.com/; _ot_ref_tip=; _ot_session_id=1609149198714; _ot_ref_b=44; _ot_last_source=; _ot_utm_type=; _ot_utm_channel=; _ot_utm_campaign=; _ot_utm_source=; _ot_utm_medium=; _ot_utm_term=; _ot_utm_content=; _ot_curr_uri_path=https://buy.mi.co.id/id/registration; _ot_referrer_path=; _ot_last_time=1609149349146; xmuuid=XMGUEST-F55153BD-7806-C131-5117-AE09F4973D9C; mstuid=1608639509934_7662; _ga=GA1.3.1564495142.1608639552; lastsource=buy.mi.co.id; msttime=https%3A%2F%2Fbuy.mi.co.id%2Fid%2Fregistration; msttime1=https%3A%2F%2Fbuy.mi.co.id%2Fid%2Fregistration; mstz=||1376181290.20|||; xm_vistor=1608639509934_7662_1609149198800-1609149353009",
        "Host: buy.mi.co.id",
        "Origin: https://buy.mi.co.id",
        "Referer: https://buy.mi.co.id/id/registration",
        "Sec-Fetch-Dest: document",
        "Sec-Fetch-Mode: navigate",
        "Sec-Fetch-Site: same-origin",
        "Sec-Fetch-User: ?1",
        "Upgrade-Insecure-Requests: 1",
        "User-Agent: Mozilla/5.0 (Linux; Android 5.0; SM-G900P Build/LRX21T) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Mobile Safari/537.36",
        'sec-ch-ua: "Google Chrome";v="87", "\"Not;A\\Brand";v="99", "Chromium";v="87"',
        "sec-ch-ua-mobile: ?1"
    ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        preg_match_all('/<p><span class="info-type">Negara pembelian: <\/span><span>(.*)<\/span>/', $response, $imei_country);
        return $imei . " | " . $imei_country[1][0];
    }
}

if(isset($argv[1])){
    $list = explode("\r\n", file_get_contents($argv[1]));
    foreach($list as $imei){
        $imeiCheck = xiaomiCountry($imei);
        echo $imeiCheck . "\n";
        file_put_contents("result.txt", $imeiCheck ."\n", FILE_APPEND);
    }
}else{
    echo "\n\tXiaomi IMEI Country Checker using Wahyu Arif Purnomo\n\t[#] Usage : php xi.php <imei.txt>\n\n";
}