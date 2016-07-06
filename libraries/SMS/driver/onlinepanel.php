<?php

class onlinepanel
{

    public static function send($to, $message, $params)
    {
        $exec = array(
            "UserName" => $params["username"],
            "Password" => $params["password"],
            "From" => $params["from"],
            "To" => $to,
            "Text" => $message,
            "UDH" => "",
            "IsFlash" => "false"
        );
        if(trim($to) != "")
            self::post("http://onlinepanel.ir/post/sendSMS.ashx",$exec);
        return true;
    }

    public static function post($url, $params)
    {

        foreach ($params as $key => &$val) {
            if (is_array($val)) $val = implode(',', $val);
            $post_params[] = $key . '=' . urlencode($val);
        }
        $post_string = implode('&', $post_params);

        $parts = parse_url($url);

        $fp = fsockopen($parts['host'],
            isset($parts['port']) ? $parts['port'] : 80,
            $errno, $errstr, 30);

        $out = "POST " . $parts['path'] . " HTTP/1.1\r\n";
        $out .= "Host: " . $parts['host'] . "\r\n";
        $out .= "Content-Type: application/x-www-form-urlencoded\r\n";
        $out .= "Content-Length: " . strlen($post_string) . "\r\n";
        $out .= "Connection: Close\r\n\r\n";
        if (isset($post_string)) $out .= $post_string;

        fwrite($fp, $out);
        fclose($fp);
    }


}