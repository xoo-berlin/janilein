<?php
/**
 * Created by PhpStorm.
 * User: JanKa
 * Date: 06.09.2015
 * Time: 15:35
 */

namespace avs;

class Semphore
{

    const FILE = 'semaphore.txt';

    static function p(){
        $fileExists = file_exists( self::FILE );

        while($fileExists){
            sleep(1);
            $fileExists = file_exists( self::FILE );
        }

        // block
        fclose(
            fopen(self::FILE, 'w+')
        );
    }

    static function v(){
        unlink( self::FILE );
    }

}