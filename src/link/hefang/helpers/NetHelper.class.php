<?php
namespace link\hefang\helpers;


use link\hefang\network\RequestOption;

class NetHelper
{
    public static function request(RequestOption $option)
    {
        $ch = curl_init($option->getUrl());
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, $option->isShowResponseHeader());
        curl_setopt($ch, CURLOPT_HTTPHEADER, $option->getHeaders());
        if ($option->getMethod() === 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            if ($option->getPostData()) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $option->getPostData());
            }
        }
        if (is_array($option->getOption())) {
            foreach ($option->getOption() as $key => $value) {
                curl_setopt($ch, $key, $value);
            }
        }

        $out = curl_exec($ch);
        curl_close($ch);
        return $out;
    }

    public static function get(string $url)
    {
        return self::request(new RequestOption($url));
    }

    public static function post(string $url, $data)
    {
        $opt = new RequestOption($url);
        $opt->setMethod('POST')
            ->setPostData($data);
        return self::request($opt);
    }
}