<?php
/**
 * Created by PhpStorm.
 * User: xoo
 * Date: 26.09.2015
 * Time: 22:52
 */


include_once '../src/Role.php';
include_once '../src/Torrent.php';


\avs\ROLE::server();

// generate n values
const N = 1000;
const SIZE = 10;

$torrent = Torrent::randomInit(N, SIZE);

// save
Torrent::put($torrent);

$torrent1 = Torrent::get();

var_dump($torrent1);

?>