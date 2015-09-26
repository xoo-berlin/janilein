<?php
/**
 * Created by PhpStorm.
 * User: JanKa
 * Date: 30.08.2015
 * Time: 11:43
 */

namespace avs;

include_once 'Globals.php';

CONST ROLE = "role";
CONST CLIENT = "client";
CONST SERVER = "server";

class Role
{

    public static function client(){
        Globals::put(ROLE, CLIENT);
    }
    public static function server(){
        Globals::put(ROLE, SERVER);
    }

    public static function isClient(){
        return strcmp( Globals::get(ROLE, ""), CLIENT) == 0;
    }
    public static function isServer(){
        return strcmp( Globals::get(ROLE, ""), SERVER) == 0;
    }

}