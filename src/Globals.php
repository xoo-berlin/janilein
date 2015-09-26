<?php
/**
 * Created by PhpStorm.
 * User: JanKa
 * Date: 29.08.2015
 * Time: 14:01
 */

namespace avs;

class Globals
{
    public static function get($name, $default)
    {
        $filename = self::name($name);
        if (file_exists($filename)) {
            $myfile = fopen($filename, "r") or die("Unable to open file!");
            $read = fread($myfile, filesize($filename));
            fclose($myfile);

            return $read;
        }
        return $default;
    }

    public static function put($name, $value){
        $myfile = fopen(self::name($name), "w") or die("Unable to open file!");
        fwrite($myfile, $value);

        fclose($myfile);
    }

    private static function name( $name ){
        return $name . ".global";
    }

    private static function nameClient( $name, $client ){
        return $name . $client;
    }


}