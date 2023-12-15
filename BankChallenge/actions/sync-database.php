<?php
$database = new Database($db);
$databaseHost = new Database($dbHost);

SyncFullDB($database, $databaseHost);
SyncFullDB($databaseHost, $database);

//Overwrites First database to Secon database
function SyncFullDB($firstDB, $secondDB){
    /// Sync Accounts Table
    SyncTable($firstDB, $secondDB, 'accounts');
    /// Sync Entries Table
    SyncTable($firstDB, $secondDB, 'entries');
    /// Sync Transfers Table
    SyncTable($firstDB, $secondDB, 'transfers');
}
// Sync the given Table
function SyncTable($firstDB, $secondDB, $table){
    // Get all Records in first table
    $rows = $firstDB->GetAllRecords($table);
    // Look for every record in first database
    foreach($rows as $row){
        $select = $secondDB->GetRecordById($table, $row['id']);
        // Is there a record in same ID in second database
        if($select){
            // Are the values same
            if($row !== $select){
                // If there is a diffrance make update
                $update = $secondDB->UpdateRecord($table, $row['id'], $row);
            }
        }
        else{
            // If there is no record, insert record to second database
            $insert = $secondDB->InsertRecord($table, $row);
        }
    }
}

?>

