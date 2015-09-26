<?php
/**
 * Created by PhpStorm.
 * User: JanKa
 * Date: 29.08.2015
 * Time: 14:01
 */

namespace avs;

// Works OUTSIDE of a class definition.
// define('LOG_ARRAY', 0);

include_once 'Globals.php';
include_once 'Item.php';
include_once 'Semphore.php';

class Logger
{
    // Works INSIDE of a class definition.
    const FILE = "avs.log";

    const TIMESTAMP = "timestamp";

    public static function resetlog(){
        Globals::put('lastPosition', 0);
        Globals::put('counter', 0);

        if(file_exists(self::FILE)) {
            unlink(self::FILE);
        }
    }

    public static function read(){
        if(file_exists(self::FILE)) {
            $myfile = fopen(self::FILE, "r") or die("Unable to open file!");
            $read = fread($myfile, filesize(self::FILE));
            fclose($myfile);

            return $read;
        }
        return "";
    }

    public static function readNew(){
        if(file_exists(self::FILE)) {
            $lastPosition = Globals::get('lastPosition', 0);

            $bytesToRead = filesize(self::FILE) - $lastPosition;

            if ($bytesToRead > 0) {
                $myfile = fopen(self::FILE, "r") or die("Unable to open file!");
                fseek($myfile, $lastPosition);

                $lastPosition += $bytesToRead;

                $read = fread($myfile, $bytesToRead);
                fclose($myfile);

                Globals::put('lastPosition', $lastPosition);

                return $read;
            }
        }

        return "";
    }

    public static function append($id, $msg){
        // blockieren
        Semphore::p();

        $counter = Globals::get('counter', 0);
        $counter++;
        Globals::put('counter', $counter);

        $textToAdd = $counter . ";" . $id . ";" . time() . ";" . $msg . PHP_EOL ;

        $myfile = fopen(self::FILE, "a") or die("Unable to open file!");
        fwrite($myfile, $textToAdd);

        fclose($myfile);

        // freigeben
        Semphore::v();
    }

    public static function asJSON( $new ){
        if( !$new ) {
            $content = self::read();
        }
        else{
            $content = self::readNew();
        }

        $rows = explode(PHP_EOL, $content);

        $itemArray = array();
        foreach( $rows as $row ){

            if( strlen(trim($row)) > 0 ) {
                $rowSplit = explode(";", $row);

                $item = new Item();
                $item->counter = $rowSplit[0];
                $item->id = $rowSplit[1];
                $item->timestamp = $rowSplit[2];
                $item->message = $rowSplit[3];

                array_push($itemArray, $item);
            }
        }

        return json_encode($itemArray);
    }

}