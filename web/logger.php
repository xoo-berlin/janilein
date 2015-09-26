<?php
/**
 * Created by PhpStorm.
 * User: JanKa
 * Date: 29.08.2015
 * Time: 14:10
 */

include_once '../src/Logger.php';

if(isset($_POST['msg'])) {
    $msg= $_POST['msg'];
    $id = $_POST['id'];

    \avs\Logger::append( $id, $msg );

} else {
    echo 'no data for msg';
};

?>
