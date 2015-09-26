<?php
/**
 * Created by PhpStorm.
 * User: JanKa
 * Date: 30.08.2015
 * Time: 11:43
 */

namespace avs;


class HttpPost
{

    public static function send($url, $params){
        //set POST variables
        $fields_string = '';

        //url-ify the data for the POST
        foreach($params as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
        rtrim($fields_string, '&');

        //open connection
        $ch = curl_init();

        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST, count($params));
        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

        //execute post
        $result = curl_exec($ch);

        //close connection
        curl_close($ch);
    }

}