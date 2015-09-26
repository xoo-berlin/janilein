<?php
/**
 * Created by PhpStorm.
 * User: JanKa
 * Date: 30.08.2015
 * Time: 11:43
 */

namespace avs;

include_once 'Globals.php';

CONST DIVISOR = ';';
CONST NAME = 'torrent-ips';

class TorrentIPs
{
    public static function myIP(){
        return getHostByName(getHostName());
    }

    public static function foreignIP(){
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            return $_SERVER['REMOTE_ADDR'];
        }
    }

    public static function get(){
        $allIPs = Globals::get(NAME, '');

        $ips = explode(DIVISOR, $allIPs);

        // $myIp = self::myIP();
        // array_unshift($ips, $myIp);

        return $ips;
    }

    public static function update($ipsString){
        // parse und append IPs
        $ipsSplitted = explode(DIVISOR, $ipsString);
        foreach ($ipsSplitted as $ipSplitted) {
            self::add($ipSplitted);
        }

        // return current / all ips
        return self::get();
    }

    public static function add($ip){
        $allIPs = Globals::get(NAME, '');

        $allIPs = $allIPs . DIVISOR . $ip;

        Globals::put(NAME, $allIPs);
    }



}