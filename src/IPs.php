<?php
/**
 * Created by PhpStorm.
 * User: JanKa
 * Date: 30.08.2015
 * Time: 11:43
 */

namespace avs;

include_once 'Globals.php';

class IPs
{

    // 1st IP = myIp
    public static function get(){
        $allIPs = Globals::get('ips', '');

        $ips = explode(";", $allIPs);

        // TODO MyIP (getHostByName(getHostName()))
        $myIp = '192.168.0.107';
        array_unshift($ips, $myIp);

        // var_dump($ips);

        return $ips;
    }

    public static function update($ipsString){
        // parse und append IPs
        $ipsSplitted = explode(";", $ipsString);
        foreach ($ipsSplitted as $ipSplitted) {
            self::add($ipSplitted);
        }

        // return current / all ips
        return self::get();
    }

    public static function add($ip){
        $allIPs = Globals::get('ips', '');

        $allIPs = $allIPs . ";" . $ip;

        Globals::put('ips', $allIPs);
    }

}