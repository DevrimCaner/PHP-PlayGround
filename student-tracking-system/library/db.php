<?php
$host = 'localhost';
$dbName = 'studenttrack';
$userName = 'root';
$dbPassword = '';

$db = new PDO('mysql:host='. $host .';dbname='.$dbName, $userName, $dbPassword);
$db->query("SET CHARACTER SET utf8");

date_default_timezone_set('Europe/Istanbul');

function Response($response){
    print_r(json_encode($response));
}
?>