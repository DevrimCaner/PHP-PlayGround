<?php
exit;
$path = 'http://localhost:8888/test/';
// Get Values
// Path
// Update
// Check Values

// Sync
$database = new Database($db);
SyncTable('accounts');
SyncTable('entries');
SyncTable('transfers');
//If Update == true send curl again as update false





// Sync the given Table
function SyncTable($table){
    // Get all Records in first table
    $rows = GetRecordsByUrl($path . '?action=get-table&table=' . $table);
    // Look for every record in first database
    foreach($rows as $row){
        $select = $database->GetRecordById($table, $row['id']);
        // Is there a record in same ID in second database
        if($select){
            // Are the values same
            if($row !== $select){
                // If there is a diffrance make update
                $update = $database->UpdateRecord($table, $row['id'], $row);
            }
        }
        else{
            // If there is no record, insert record to second database
            $insert = $database->InsertRecord($table, $row);
        }
    }
}
function GetRecordsByUrl($url){
    // Initialize cURL session
    $curl = curl_init($url);
    // Set cURL options
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    // Execute cURL session and get the response
    $response = curl_exec($curl);
    // Check for cURL errors
    if (curl_errno($curl)) {
        $response = new Response("error", "cURL Request has been failed.");
        $response->Exit();
    }
    // Close cURL session
    curl_close($curl);
    
    return json_decode($response);
}
?>
