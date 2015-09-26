<?php
/**
 * Created by PhpStorm.
 * User: xoo
 * Date: 26.09.2015
 * Time: 22:52
 */
include_once '../src/Torrent.php';
include_once '../src/Slice.php';
include_once '../src/TorrentIPs.php';


const AMOUNT = 'n';
const DEF= 2;

$count = isset($_GET[AMOUNT]) ? $_GET[AMOUNT] : DEF;

$torrent = Torrent::get();

// init slice response
$sliceResponse = new \avs\SliceResponse();
$sliceResponse->count = $torrent->count;

// get slices
for( $x = 0; $x < $count; $x++ ) {
    $id = rand(0, $torrent->count);
    $message = $torrent->messages[$id];

    $slice = new \avs\Slice();
    $slice->id = $id;
    $slice->message = $message;

    array_push(
        $sliceResponse->slices,
        $slice
    );
}

// get torrent IPs
$foreignIP = \avs\TorrentIPs::foreignIP();
\avs\TorrentIPs::add($foreignIP);
$torrentIPs = \avs\TorrentIPs::get();
$sliceResponse->ips = $torrentIPs;

var_dump($sliceResponse);


