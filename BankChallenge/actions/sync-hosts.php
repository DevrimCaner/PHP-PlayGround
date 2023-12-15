<?php
$database = new Database($db);
$databaseHost = new Database($dbHost);

/// Sync Accounts Table
// Get all Accounts in first table
$rows = $database->GetAllRecords('accounts');
// Look for every account in first database
foreach($rows as $row){
    $select = $databaseHost->GetRecordById('accounts', $row['id']);
    // Is there a record in same ID in second database
    if($select){
        // Are the values same
        if($row !== $select){
            // If there is a diffrance make update
            $update = $databaseHost->UpdateRecord('accounts', $row['id'], ['owner' => $row['owner'], 'balance' => $row['balance'], 'currency' => $row['currency'], 'created_at' => $row['created_at']]);
        }
    }
    else{
        // If there is no record, insert record to second database
        $insert = $databaseHost->InsertRecord('accounts', $row);
    }
}






/// Sync Entries Table

/// Sync Transfers Table

?>

