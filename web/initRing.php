<?php
/**
 * Created by PhpStorm.
 * User: JanKa
 * Date: 29.08.2015
 * Time: 14:10
 */

include_once ('../src/IPs.php');
include_once ('../src/HttpGet.php');

function init()
{
    $ips = \avs\IPs::get();

    // ip1, ip2, ip3, ...
    // ip1 -> ip2
    // ip2 -> ip3
    // ip3 -> ip1

    // do we have enough
    // attention: $ips contains our local IP
    if (count($ips) > 1) {
        for ($index = 0, $count = count($ips); $index < $count - 1; $index++) {

            $ip = $ips[$index];
            $neighborIp = $ips[$index + 1];

            // sende 0->1, 1->2, 2-3, 3-4 etc
            inform($ip, $neighborIp);
        }

        // 1st  / last
        $count = count($ips);
        $myIp = $ips[0];
        $lastIp = $ips[$count-1];

        // sende last->0
        inform($lastIp, $myIp);
    } else {
        echo("too less known IPs");
    }
}

function inform( $ip, $neighbor ){
    $urlToCall = "http://" . $ip . "/AVS-U1/web/yourNeighbor.php" . "?ip=" . $neighbor;
    \avs\HttpGet::get($urlToCall);

    echo("Inform: " . $ip . " about neighbor: " . $neighbor );
}

init();

?>