<?php
// Get Values
$from = isset($_GET['from']) ? $_GET['from'] : null;
$to = isset($_GET['to']) ? $_GET['to'] : null;
$amount = isset($_GET['amount']) ? $_GET['amount'] : null;


// Check Values
// If account is null
if(!$from){
    $response = new Response("error", "From-Account cannot be null.");
    $response->Exit();
}
// If account is null
if(!$to){
    $response = new Response("error", "To-Account cannot be null.");
    $response->Exit();
}
// If amount is null
if(!$amount){
    $response = new Response("error", "Amount cannot be null.");
    $response->Exit();
}
// If account not numeric
if(!is_numeric($from)){
    $response = new Response("error", "Invalid From-Account data.");
    $response->Exit();
}
// If account not numeric
if(!is_numeric($to)){
    $response = new Response("error", "Invalid To-Account data.");
    $response->Exit();
}
// If amount not numeric
if(!is_numeric($amount)){
    $response = new Response("error", "Invalid amount data.");
    $response->Exit();
}
// If amount less then zero
if($amount < 0){
    $response = new Response("error", "Amount must be bigger then zero.");
    $response->Exit();
}

// Define database
$database = new Database($db);

// Check From-Account Exist
$fromData = $database->GetRecordById('accounts', $from);
if(!$fromData){
    $response = new Response("error", "The Given From-Account Does Not Exist.");
    $response->Exit();
}
// Check To-Account Exist
$toData = $database->GetRecordById('accounts', $to);
if(!$toData){
    $response = new Response("error", "The Given To-Account Does Not Exist.");
    $response->Exit();
}
// Check Accounts is in same currency
if($fromData['currency'] !== $toData['currency']){
    $response = new Response("error", "The Accounts must be in same currency.");
    $response->Exit();
}

// Calculate From Account New balance
$currentFromBalance = $fromData['balance'];
$newFromBalance = $currentFromBalance - $amount;
// Check if  from-account will go below zero
if($newFromBalance < 0){
    $response = new Response("error", "Not enough balance in From-Account");
    $response->Exit();
}
// Calculate To Account New balance
$currentToBalance = $toData['balance'];
$newToBalance = $currentToBalance + $amount;

// Insert transfer
$insert = $database->InsertRecord('transfers', ['from_account_id' => $from, 'to_account_id' => $to, 'amount' => $amount]);
// Check Insert
if(!$insert){
    $response = new Response("error", "There is an error while making transfer, please try again later.");
    $response->Exit();
}
// Update From Account
$FromUpdate = $database->UpdateRecord('accounts', $from, ['balance' => $newFromBalance]);
// Check From Account Update
if(!$FromUpdate){
    $response = new Response("error", "There is an error while updating account, please try again later.");
    $response->Exit();
}
// Update To Account
$ToUpdate = $database->UpdateRecord('accounts', $to, ['balance' => $newToBalance]);
// Response
if($ToUpdate){
    $response = new Response("success", "Transfer has been successful.");
    $response->Exit();
}
else{
    $response = new Response("error", "There is an error while updating account, please try again later.");
    $response->Exit();
}
?>