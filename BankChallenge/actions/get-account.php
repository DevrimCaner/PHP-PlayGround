<?php
// Get Account Value
$account = isset($_GET['account']) ? $_GET['account'] : null;
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

$database = new Database($db);
// Check Account Exist
$select = $database->GetRecordById('accounts', $account);
if($select){
    echo json_encode($select);
    exit;
}
else{
    $response = new Response("error", "The Given Account Does Not Exist.");
    $response->Exit();
}
?>