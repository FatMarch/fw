<?php

namespace App\Libs;

class Curl
{
    public static function get($url)
    {
        $ch = curl_init();//初始化curl
        curl_setopt($ch, CURLOPT_URL, $url);//设置url属性
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $output = curl_exec($ch);//获取数据
        curl_close($ch);//关闭curl

        return $output;
    }

    public static function post($url, $data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $output = curl_exec($ch);
        curl_close($ch);

        return $output;
    }

    /**
     * @param string $url 请求网址
     * @param bool $params 请求参数
     * @param int  $isPost 请求方式
     * @param int  $https https协议
     * @return bool|mixed
     */
    public static function curl($url, $params = false, $isPost = 0, $https = 0)
    {
        $httpInfo = array();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36');
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if ($https) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // 对认证证书来源的检查
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); // 从证书中检查SSL加密算法是否存在
        }
        if ($isPost) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            curl_setopt($ch, CURLOPT_URL, $url);
        } else {
            if ($params) {
                if (is_array($params)) {
                    $params = http_build_query($params);
                }
                curl_setopt($ch, CURLOPT_URL, $url . '?' . $params);
            } else {
                curl_setopt($ch, CURLOPT_URL, $url);
            }
        }

        $response = curl_exec($ch);
        if ($response === false) {
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $httpInfo = array_merge($httpInfo, curl_getinfo($ch));
            if (env('APP_DEBUG')) {
                var_dump(curl_error($ch), $httpCode, $httpInfo);
            }

            return false;
        }
        curl_close($ch);

        return $response;
    }
}