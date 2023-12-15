<?php
// Get Values
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = isset($_GET['limit']) ? $_GET['limit'] : 10;

// Check Values
// If page not numeric
if(!is_numeric($page)){
    $response = new Response("error", "Invalid page data.");
    $response->Exit();
}
// If limt not numeric
if(!is_numeric($limit)){
    $response = new Response("error", "Invalid limit data.");
    $response->Exit();
}
// Check if page less than 1
if($page < 1){
    $response = new Response("error", "Page must be bigger than 1.");
    $response->Exit();
}
// Check if limit less than 1
if($limit < 1){
    $response = new Response("error", "Limit must be bigger than 1.");
    $response->Exit();
}
// Calculate Offset
$offset = ($page * $limit) - $limit;

$database = new Database($db);
// Select Records
$select = $database->GetRecordsByOffset('accounts', $offset, $limit);
if($select){
    echo json_encode($select);
    exit;
}
else{
    $response = new Response("error", "No Record Found.");
    $response->Exit();
}
?>