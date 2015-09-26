<?php
/**
 * Created by PhpStorm.
 * User: JanKa
 * Date: 30.08.2015
 * Time: 11:43
 */

namespace avs;


class HttpGet
{

    public static function get($url){
        // create curl resource
        $ch = curl_init();

        // set url
        curl_setopt($ch, CURLOPT_URL, $url);

        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // $output contains the output string
        $output = curl_exec($ch);

        // close curl resource to free up system resources
        curl_close($ch);

        return $output;
    }

}