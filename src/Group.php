<?php
/**
 * Created by PhpStorm.
 * User: JanKa
 * Date: 30.08.2015
 * Time: 11:43
 */

namespace avs;

include_once 'Globals.php';

class Group
{
    public static function get(){
        return Globals::get('group', '');
    }

    public static function update($name){
        Globals::put('group', $name);

        // return current name
        return self::get();
    }

}