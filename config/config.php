<?php 

define('BASE_PATH', dirname(dirname(__FILE__)));
define('APP_FOLDER','/admin');

require_once BASE_PATH.'/lib/MysqliDb.php';

// $servername = "thereallifebo.c8js7xop6tz8.us-east-2.rds.amazonaws.com";
$servername = "localhost";
$username = "treall";
$password = "soojelay6209";
$dbname = "treall";

$db =new MysqliDb($servername,$username,$password,$dbname);
?>