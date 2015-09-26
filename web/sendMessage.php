<?php
/**
 * Created by PhpStorm.
 * User: JanKa
 * Date: 29.08.2015
 * Time: 14:10
 */

include_once '../src/Logger.php';
include_once ('../src/Neighbor.php');
include_once ('../src/Globals.php');
include_once ('../src/HttpPost.php');

if(isset($_POST['msg'])) {
    $msg= $_POST['msg'];
    $id = $_POST['id'];

    // get last message for comparison
    $lastMsg = \avs\Globals::get('lastmessage', '');

    if( strlen($msg) > 0) {
        // wenn nachrichten unterschiedlich, loggen + senden
        if( strcmp( $msg, $lastMsg ) != 0 ) {

            // local logging
            \avs\Logger::append($id, $msg);

            // persist last message for (next) comparison
            \avs\Globals::put('lastmessage', $msg);

            // neighbor ermitteln
            $neighborIP = \avs\Neighbor::get();

            // wenn ein neighbor da, schicken
            if (null != $neighborIP && strlen($neighborIP) > 0) {
                $urlToCall = "http://" . $neighborIP . "/AVS-U1/web/sendMessage.php";

                $params = array(
                    'msg' => urlencode($msg),
                    'id' => urlencode($id)
                );

                \avs\HttpPost::send($urlToCall, $params);
            }
        }
    }

} else {
    echo 'no data for msg';
};

?>
