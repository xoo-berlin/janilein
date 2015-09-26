<?php
/**
 * Created by PhpStorm.
 * User: JanKa
 * Date: 29.08.2015
 * Time: 14:10
 */

include_once('../src/Group.php');
include_once('../src/Neighbor.php');

if(isset($_GET['ip'])) {
    $ip= $_GET['ip'];

    \avs\Group::update( 'jan' );
    \avs\Neighbor::update( $ip );

} else {
    echo 'no data for ip';
};

?>
