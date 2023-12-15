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

$dbHost2 = 'localhost';
$dbName2 = 'bankChallengeHost';
$dbUser2 = 'root';
$dbPass2 = 'root';
try{
    $dbHost = new PDO("mysql:host=$dbHost2;dbname=$dbName2;", $dbUser2, $dbPass2);
}
catch(PDOExeception $e){
    die($e->getMessage());
}
?>