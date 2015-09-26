<?php
/**
 * Created by PhpStorm.
 * User: JanKa
 * Date: 29.08.2015
 * Time: 16:27
 */

include_once '../src/Logger.php';

$new = isset($_GET['new']);

echo(\avs\Logger::asJSON($new));