<?php
/**
 * Created by PhpStorm.
 * User: JanKa
 * Date: 06.09.2015
 * Time: 14:33
 */

namespace avs;

include_once('Item.php');

class Item
{
    var $counter;
    var $id;
    var $timestamp;
    var $message;

    public static function fromJSON( $json )
    {
        $jsonItems = json_decode($json);

        $itemArray = array();

        foreach ($jsonItems as $jsonItem) {
            $item = new Item();
            $item->counter = $jsonItem->counter;
            $item->id = $jsonItem->id;
            $item->timestamp = $jsonItem->timestamp;
            $item->message = $jsonItem->message;

            array_push($itemArray, $item);
        }

        return $itemArray;
    }

    public static function sortItems( $array ){
        $sorted = usort($array,
            function($left, $right) {
                $leftValue = $left->timestamp;
                $rightValue = $right->timestamp;

                return strcmp($leftValue, $rightValue);
            }
        );

        return $sorted;
    }
}