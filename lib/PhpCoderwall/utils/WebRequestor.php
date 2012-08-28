<?php

namespace PhpCoderwall\Utils;

class WebRequestor {

    public static function request($url, $headerdata = array())
    {

        if (!$headerdata || !is_array($headerdata))
        {
            $headerdata = array(
                'http' => array(
                    'method' => "GET",
                    'header' => "Accept: application/json\r\n"
                )
            );
        }


        $headers = stream_context_create($headerdata);

        if (function_exists('curl_init'))
        {
            return self::getCurlWrapper($url, $headers);
        }
        
        return @file_get_contents($url, false, $headers);
    }

    private static function getCurlWrapper ($url, $headers)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $contents = curl_exec($ch);
        curl_close($ch);
        return $contents;
    }

}