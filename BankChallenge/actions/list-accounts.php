<?php
// Get Values
$page = isset($_GET['page']) ? $_GET['page'] : null;
$limit = isset($_GET['limit']) ? $_GET['limit'] : null;

// Check Values
// If page is null
if(!$page){
    $response = new Response("error", "Account cannot be null.");
    $response->Exit();
}
// If page not numeric
if(!is_numeric($page)){
    $response = new Response("error", "Invalid account data.");
    $response->Exit();
}
// If limit is null
if(!$limit){
    $response = new Response("error", "Account cannot be null.");
    $response->Exit();
}
// If limt not numeric
if(!is_numeric($limit)){
    $response = new Response("error", "Invalid account data.");
    $response->Exit();
}

$database = new Database($db);
// Select Records
$select = $database->GetAllRecords('accounts');
if($select){
    echo json_encode($select);
    exit;
}
else{
    $response = new Response("error", "No Record Found.");
    $response->Exit();
}
?>