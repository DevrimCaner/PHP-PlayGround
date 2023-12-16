<?php
// Get Values
$path = isset($_GET['path']) ? htmlspecialchars(trim($_GET['path'])) : null;
$update = isset($_GET['update']) ? $_GET['update'] : null;

// Check Values
if(!$path){
    $response = new Response("error", "Path required.");
    $response->Exit();
}
if(!$update){
    $response = new Response("error", "Update information required..");
    $response->Exit();
}
if($update != 'true' && $update != 'false'){
    $response = new Response("error", "Please Set Update value as 'true' or 'false'.");
    $response->Exit();
}

// Import Sync Library
include_once 'library/Sync.php';
// Sync All tables
SyncTable('accounts', $path);
SyncTable('entries', $path);
SyncTable('transfers', $path);
// If Update setted true, send sync request to path
if($update == 'true'){
    // Get the current Url
    $thisURL = ($_SERVER['HTTPS'] ?? 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $parsedUrl = parse_url($thisURL);
    // Set the url to be used in curl
    $url = $path . "?action=sync-hosts&path=" . $parsedUrl['path'] . "&update=false";
    // Initialize cURL session
    $curl = curl_init($url);
    // Set cURL options
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    // Execute cURL session and get the response
    $response = curl_exec($curl);
    // Close cURL session
    curl_close($curl);
}
// Response
$response = new Response("success", "Synchronization is successful.");
$response->Exit();
?>
