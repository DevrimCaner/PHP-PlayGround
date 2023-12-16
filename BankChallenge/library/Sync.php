<?php
// Sync the given Table
function SyncTable($table, $path){
    // Get all Records in first table
    $rows = GetRecordsByUrl($path . '?action=get-table&table=' . $table);
    if(!$rows){
        return;
    }
    // Create Database Object
    global $db;
    $database = new Database($db);
    // Look for every record in first database
    foreach($rows as $row){
        // Convert Php object into array
        $rowData = (array)$row;
        // Try to find record on this host
        $select = $database->GetRecordById($table, $rowData['id']);
        // Is there a record in same ID in second database
        if($select){
            // Are the values same
            if($rowData !== $select){
                // If there is a diffrance make update
                $update = $database->UpdateRecord($table, $rowData['id'], $rowData);
            }
        }
        else{
            // If there is no record, insert record to second database
            $insert = $database->InsertRecord($table, $rowData);
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
    // Convert response into php object
    $rows = json_decode($response);
    // Is there any recors
    if(is_array($rows)){
        return $rows;
    }
    else{
        return null;
    }
}
?>