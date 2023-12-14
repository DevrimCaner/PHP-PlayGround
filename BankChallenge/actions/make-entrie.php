<?php
// Get Values
$account = isset($_GET['account']) ? $_GET['account'] : null;
$amount = isset($_GET['amount']) ? $_GET['amount'] : null;


// Check Values
// If account is null
if(!$account){
    $response = new Response("error", "Account cannot be null.");
    $response->Exit();
}
// If amount is null
if(!$amount){
    $response = new Response("error", "Amount cannot be null.");
    $response->Exit();
}
// If account not numeric
if(!is_numeric($account)){
    $response = new Response("error", "Invalid account data.");
    $response->Exit();
}
// If amount not numeric
if(!is_numeric($amount)){
    $response = new Response("error", "Invalid amount data.");
    $response->Exit();
}

// Define database
$database = new Database($db);
// Check Account Exist
$accountData = $database->GetRecordById('accounts', $account);
if(!$accountData){
    $response = new Response("error", "The Given Account Does Not Exist.");
    $response->Exit();
}
// Calculate
$currentBalance = $accountData['balance'];
$newBalance = $currentBalance + $amount;
// Check if your account will go below zero
if($newBalance < 0){
    $response = new Response("error", "Not enough balance in account");
    $response->Exit();
}
// Insert Entrie
$insert = $database->InsertRecord('entries', ['account_id' => $account, 'amount' => $amount]);
// Check Insert
if(!$insert){
    $response = new Response("error", "There is an error while making entrie, please try again later.");
    $response->Exit();
}

// Update Account
$update = $database->UpdateRecord('accounts', $account, ['balance' => $newBalance]);
// Response
if($update){
    $response = new Response("success", "Entrie has been successful.");
    $response->Exit();
}
else{
    $response = new Response("error", "There is an error while updating account, please try again later.");
    $response->Exit();
}
?>