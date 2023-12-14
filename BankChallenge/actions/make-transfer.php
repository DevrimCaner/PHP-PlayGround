<?php
// Get Values
$owner = isset($_GET['owner']) ? htmlspecialchars(trim($_GET['owner'])) : null;
$currency = isset($_GET['currency']) ? htmlspecialchars(trim($_GET['currency'])) : null;


// Check Values
// If Owner is null
if(!$owner){
    $response = new Response("error", "Owner cannot be null.");
    $response->Exit();
}
// If currency is null
if(!$currency){
    $response = new Response("error", "Currency cannot be null.");
    $response->Exit();
}
// Owner lengt must be between 4 and 32
if(strlen($owner) < 4 || strlen($owner) > 32){
    $response = new Response("error", "Owner must be between 4 and 32 characters.");
    $response->Exit();
}
// Currency lengt must be between 4 and 32
if(strlen($currency) < 1 || strlen($currency) > 4){
    $response = new Response("error", "Currency must be between 1 and 4 characters.");
    $response->Exit();
}

// Insert
$database = new Database($db);
$insert = $database->InsertRecord('accounts', ['owner' => $owner, 'currency' => $currency]);
// Response
if($insert){
    $response = new Response("success", "Account Created Successfully.");
    $response->Exit();
}
else{
    $response = new Response("error", "There is an error while creating account, please try again later.");
    $response->Exit();
}
?>