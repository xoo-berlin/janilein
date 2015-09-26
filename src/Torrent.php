<?php
/**
 * Created by PhpStorm.
 * User: xoo
 * Date: 26.09.2015
 * Time: 22:56
 */

include_once '../src/Globals.php';


CONST NAME = 'torrentvalues';

class Torrent
{

    var $count = 0;
    var $messages = array();

    public static function get()
    {
        $str = \avs\Globals::get("torrentvalues", '');
        return Torrent::fromJSON($str);
    }

    public static function put($torrent){
        $jsonTorrent = json_encode($torrent);
        \avs\Globals::put( NAME, $jsonTorrent );
    }

    public static function fromJSON( $json )
    {
        $decoded = json_decode($json);

        $torrent = new Torrent();
        $torrent->count = $decoded->count;
        $torrent->messages = $decoded->messages;

        return $torrent;
    }

    public static function randomInit( $count, $length ){
        $torrent = new Torrent();

        $torrent->count = $count;

        for ($x = 0; $x <= $count; $x++) {
            array_push( $torrent->messages, self::randomstring($length) );
        }

        return $torrent;
    }

    static function randomstring($length = 6) {
        // $chars - String aller erlaubten Zahlen
        $chars = "!#abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
        // Funktionsstart
        srand((double)microtime()*1000000);
        $i = 0; // Counter auf null
        $pass = '';
        while ($i < $length) { // Schleife solange $i kleiner $length
            // Holen eines zufälligen Zeichens
            $num = rand() % strlen($chars);
            // Ausf&uuml;hren von substr zum wählen eines Zeichens
            $tmp = substr($chars, $num, 1);
            // Anhängen des Zeichens
            $pass .= $tmp;
            // $i++ um den Counter um eins zu erhöhen
            $i++;
        }
        // Schleife wird beendet und
        // $pass (Zufallsstring) zurück gegeben
        return $pass;
    }
}