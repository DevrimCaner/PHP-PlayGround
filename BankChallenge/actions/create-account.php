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
// Owner regex control
if (!preg_match("/^[a-zA-Z ]{4,32}$/", $owner)) {
    $response = new Response("error", "Invalid format for owner.");
    $response->Exit();
}

// Currency regex control
if (!preg_match("/^[A-Z]{1,4}$/", $currency)) {
    $response = new Response("error", "Invalid format for currency.");
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