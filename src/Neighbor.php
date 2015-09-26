<?php
/**
 * Created by PhpStorm.
 * User: JanKa
 * Date: 30.08.2015
 * Time: 11:43
 */

namespace avs;

include_once 'Globals.php';

class Neighbor
{
    public static function get(){
        return Globals::get('neighbor', '');
    }

    public static function update($ipString){
        Globals::put('neighbor', $ipString);

        // return current neighbor ip
        return self::get();
    }

}