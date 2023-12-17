<?php
// Get Values
$account = isset($_GET['account']) ? $_GET['account'] : null;


// Check Values
// If account is null
if(!$account){
    $response = new Response("error", "Account cannot be null.");
    $response->Exit();
}
// If account not numeric
if(!is_numeric($account)){
    $response = new Response("error", "Invalid account data.");
    $response->Exit();
}
// Check Account Exist
$database = new Database($db);
$accountData = $database->GetRecordById('accounts', $account);
if(!$accountData){
    $response = new Response("error", "The Given Account Does Not Exist.");
    $response->Exit();
}
// Check ballance is zero
if(intval($accountData['balance']) !== 0){
    $response = new Response("error", "Account balance must be zero before deleted.");
    $response->Exit();
}

// Delete Entries
$deleteEntries = $database->DeleteRecord('entries', ['account_id' => $account]);
// Delete Transfers as From-Account
$deleteFromAccount = $database->DeleteRecord('transfers', ['from_account_id' => $account]);
// Delete Transfers as To-Account
$deleteToAccount = $database->DeleteRecord('transfers', ['to_account_id' => $account]);

// Delete Account
$deleteAccount = $database->DeleteRecord('accounts', ['id' => $account]);
// Response
if($deleteAccount){
    $response = new Response("success", "Account Deleted Successfully.");
    $response->Exit();
}
else{
    $response = new Response("error", "There is an error while deleting account, please try again later.");
    $response->Exit();
}
?>