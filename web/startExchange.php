<?php
/**
 * Created by PhpStorm.
 * User: xoo
 * Date: 26.09.2015
 * Time: 22:52
 */

/**
Wenn sich alle Clients angemeldet haben, indem sie sich eine Scheibe
geholt haben, wird bei Alice erneut auf den ersten Knopf gedrückt. Dann
wird bei Alice die Routine startExchange.php aufgerufen, die als Server
bei allen Rechnern in der IP-Liste ein startExchange.php aufruft. Da diese
als Clients laufen, beginnt der Austausch, indem diese untereinander
exchange.php aufrufen, um dadurch die fehlenden Stücke sowie die Liste
der IP-Adressen des Partners zu erhalten. Jeder Client befragt alle
anderen Clients, auch die, von denen er später erst erfährt.
*/

include_once '../src/Role.php';

// inform clients, wenn ich server bin
$isServer = \avs\Role::isServer();
if( $isServer ) {
    $torrentIPs = \avs\TorrentIPs::get();

    foreach ($torrentIPs as $clientIP) {
        $url = 'http://' . $clientIP . "/web/startExchange.php";
        // call
        \avs\HttpGet::get($url);
    }
}

$isClient = \avs\Role::isClient();
if( $isClient ){
    // clients lesen
    $torrentIPs = \avs\TorrentIPs::get();

    foreach ($torrentIPs as $clientIP) {
        $url = 'http://' . $clientIP . "/web/exchange.php";
        // call
        $exchangeResult = \avs\HttpGet::get($url);

        Slice

        // TODO neue ips
        // TODO daten speichern
    }
}