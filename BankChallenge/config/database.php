<?php
$dbHost = 'localhost';
$dbName = 'bankChallenge';
$dbUser = 'root';
$dbPass = 'root';
try{
    $db = new PDO("mysql:host=$dbHost;dbname=$dbName;", $dbUser, $dbPass);
}
catch(PDOExeception $e){
    die($e->getMessage());
}
?>