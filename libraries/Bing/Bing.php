<?php

class Bing
{
    public static function getImage($path)
    {
        $bing_image = $path . DS . "bing.jpg";

        if (!file_exists($bing_image) || File::olderThan($bing_image, 3600 * 24)) {
            $obj = getJSON("http://www.bing.com/HPImageArchive.aspx?format=js&idx=0&n=1&mkt=en-US", true);
            $image = "http://bing.com" . @$obj["images"][0]["url"];

            $temp = $path . DS . "bing.temp";
            copy($image, $temp);

            if (exif_imagetype($temp) == IMAGETYPE_JPEG) {
                copy($temp, $path . DS . "bing.jpg");
                unlink($temp);
                file_put_contents($path . DS . "bing.txt", $obj["images"][0]["copyright"]);
            }
        }
        return json_encode(["status" => true]);
    }
}