<?php
/**
 * Created by PhpStorm.
 * User: JanKa
 * Date: 29.08.2015
 * Time: 16:27
 */

include_once '../src/Logger.php';
include_once '../src/IPs.php';
include_once '../src/HttpGet.php';

// $ips = \avs\IPs::get();
$ips = array();
if( isset($_GET['ips'])) {
    $ips = \avs\IPs::update($_GET['ips']);
}
else{
    $ips = \avs\IPs::get();
}

$allItems = array();

if( null != $ips && count($ips)>0 ){
    foreach ($ips as $ip) {
        if( null != $ip && strlen($ip) > 0) {
            $url = "http://" . $ip . "/AVS-U1/web/getLoggerJSON.php";
            // echo("requesting: " . $url);

            $remoteJSON = \avs\HttpGet::get($url);
            // echo("remoteJSON: " . $remoteJSON);

            if (strlen($remoteJSON) > 0) {
                $remoteItems = \avs\Item::fromJSON($remoteJSON);
                $allItems = array_merge($allItems, $remoteItems);
            }
        }
    }
}

$allItems = array_merge( $allItems );

$sorted = \avs\Item::sortItems($allItems);

var_dump($sorted);


$html = "<table border='1'>";

$even = true;

foreach( $allItems as $item ){

    $html .= "<tr>";

    foreach( $item as $attribute ) {
        $html .= "<td>{$attribute}</td>";
    }

    $html .= "</tr>";

}
$html .= "</table>";

echo( $html);

