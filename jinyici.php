<?php

for ($i = 1; $i < 1114; $i++) {
    $api = getJson('https://sp0.baidu.com/8aQDcjqpAAV3otqbppnN2DJv/api.php?resource_id=28204&from_mid=1&&format=json&ie=utf-8&oe=utf-8&query=%E8%AF%8D%E8%AF%AD%E5%A4%A7%E5%85%A8&sort_key=&sort_type=1&stat0=&stat1=&stat2=&stat3=&pn=' . ($i * 40) . '&rn=40&cb=jQuery110209524803849737442_' . (ceil(getMsectime()) - ceil(mt_rand(30, 50))) . '&_=' . ceil(getMsectime()));
    if ($api[1] === 200) {
        preg_match_all("/ename\"\:\"(.*?)\"/ui", $api[0], $match);
        foreach ($match[1] as $key => $val) {
            file_put_contents('ciku.txt', unicode_decode($val) . PHP_EOL, FILE_APPEND | LOCK_EX);
        }
    }
}

// $dictData = $this->getDict();

// foreach ($dictData as $key => $val) {
//     if (strstr($val, ",")) {
//         $dict = explode(",", $val);
//         $dicDA[trim($key)] = trim($dict[0]);
//         for ($i = 0; $i < count($dict); $i++) {
//             if (!empty($dict[$i + 1])) {
//                 $dicDA[trim($dict[$i])] = trim($dict[$i + 1]);
//             }
//         }
//         $dicDA[trim($dict[count($dict) - 1])] = trim($key);
//     } else {
//         $dicDA[trim($key)] = trim($val);
//     }
// }

// $i = 0;
// foreach (array_flip(array_flip($dicDA)) as $key => $val) {
//     if (strlen($key) < 6) {
//         continue;
//     }
//     $i++;
//     echo '\'' . $key . '\' => \'' . $val . '\',' . ($i % 5 === 0 ? PHP_EOL : '');
// }
// exit();

/*
for ($i = 1; $i < 60; $i++) {

    $api = getJson('https://sp0.baidu.com/8aQDcjqpAAV3otqbppnN2DJv/api.php?resource_id=28204&from_mid=1&&format=json&ie=utf-8&oe=utf-8&query=%e5%85%ab%e5%ad%97%e8%af%8d%e8%af%ad%e5%a4%a7%e5%85%a8&sort_key=&sort_type=1&stat0=&stat1=&stat2=&stat3=&pn=' . ($i * 40) . '&rn=40&cb=jQuery110209524803849737442_' . (ceil(getMsectime()) - ceil(mt_rand(30, 50))) . '&_=' . ceil(getMsectime()));

    if ($api[1] === 200) {
        preg_match_all("/jumplink\"\:\"(.*?)\"/ui", $api[0], $match);

        foreach ($match[1] as $key => $val) {

            $api = getJson(str_replace('\\', '', $val));

            if ($api[1] === 200) {
                preg_match_all("/<label>近义词 <\/label>.*?<div class=\"block\">(.*?)<\/div>/ui", $api[0], $matchs);

                if (empty($matchs[1])) {
                    continue;
                }

                preg_match_all("/value=\"(.*?)\" maxlength=\"40\"/ui", $api[0], $title);

                preg_match_all("/<a.*?>(.*?)<\/a>/ui", implode("", $matchs[1]), $matchs);

                file_put_contents('ba.txt', '\'' . $title[1][0] . '\' => \'' . implode(",", $matchs[1]) . '\',' . PHP_EOL, FILE_APPEND | LOCK_EX);

                unset($matchs);
            } else {

                file_put_contents('baurl.txt', $val . PHP_EOL, FILE_APPEND | LOCK_EX);
            }
        }
    } else {

        file_put_contents('bajson.txt', $id . PHP_EOL, FILE_APPEND | LOCK_EX);
    }
}*/

function getJson($url)
{
    $randIP = getRandIP();
    $user_agent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:75.0) Gecko/20100101 Firefox/75.0';
    $options =  array(
        CURLOPT_URL => $url,
        CURLOPT_TIMEOUT => 15,
        CURLOPT_HTTPGET => TRUE,
        CURLOPT_NOBODY => FALSE,
        CURLOPT_HEADER => FALSE,
        CURLOPT_REFERER => $url,
        CURLOPT_USERAGENT => $user_agent,
        CURLOPT_RETURNTRANSFER => TRUE,
        CURLOPT_FOLLOWLOCATION => TRUE,
        CURLOPT_SSL_VERIFYPEER => FALSE,
        CURLOPT_SSL_VERIFYHOST => FALSE,
        CURLOPT_HTTPHEADER => array('Content-Type: text/plain', 'X-FORWARDED-FOR:' . $randIP, 'CLIENT-IP:' . $randIP),
    );

    $ch = curl_init();
    curl_setopt_array($ch, $options);
    $result = curl_exec($ch);
    $Code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return array(str_replace(array("\r", "\n", "\r\n"), "", str_to_utf8($result)), $Code);
}

function getRandIP()
{
    $ip2id = round(rand(600000, 2550000) / 10000);
    $ip3id = round(rand(600000, 2550000) / 10000);
    $ip4id = round(rand(600000, 2550000) / 10000);
    $_array = array('218', '218', '66', '66', '218', '218', '60', '60', '202', '204', '66', '66', '66', '59', '61', '60', '222', '221', '66', '59', '60', '60', '66', '218', '218', '62', '63', '64', '66', '66', '122', '211');
    $randarr = mt_rand(0, count($_array) - 1);
    $ip1id = $_array[$randarr];
    return $ip1id . '.' . $ip2id . '.' . $ip3id . '.' . $ip4id;
}

function str_to_utf8($str = '')
{
    $current_encode = mb_detect_encoding($str, array("ASCII", "GB2312", "GBK", 'BIG5', 'UTF-8'));
    $encoded_str = mb_convert_encoding($str, 'UTF-8', $current_encode);
    return $encoded_str;
}

function getMsectime()
{
    list($msec, $sec) = explode(' ', microtime());
    $msectime = (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);
    return $msectime;
}

function unicode_decode($value)
{
    $pattern = '/([\w]+)|(\\\u([\w]{4}))/i';
    preg_match_all($pattern, $value, $matches);
    if (!empty($matches)) {
        $value = '';
        for ($j = 0; $j < count($matches[0]); $j++) {
            $str = $matches[0][$j];
            if (strpos($str, '\\u') === 0) {
                $code = base_convert(substr($str, 2, 2), 16, 10);
                $code2 = base_convert(substr($str, 4), 16, 10);
                $c = chr($code) . chr($code2);
                $c = iconv('UCS-2', 'UTF-8', $c);
                $value .= $c;
            } else {
                $value .= $str;
            }
        }
    }
    return $value;
}
