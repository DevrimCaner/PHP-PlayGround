<?php
include_once 'config/header.php';
include_once 'library/Response.php';
// Check is Action Defined
if(!isset($_GET['action'])){
    $response = new Response("error", "No Action Defined.");
    $response->ExitScript();
}
// Import Database Config and Class
include_once 'config/database.php';
include_once 'library/Database.php';
// Action switch
switch($_GET['action']){
    case 'test':
        $response = new Response("success", "Test Action.");
        $response->ExitScript();
        /*
        $database = new Database($db);
        $allRecords = $database->getAllRecords('your_table_name');
        $recordById = $database->getRecordById('your_table_name', 1);
        $newRecordId = $database->insertRecord('your_table_name', ['column1' => 'value1', 'column2' => 'value2']);
        $updatedRowCount = $database->updateRecord('your_table_name', 1, ['column1' => 'new_value1', 'column2' => 'new_value2']);
        $deletedRowCount = $database->deleteRecord('your_table_name', 1);
        */

    break;
    default:
        $response = new Response("error", "Undefined Action.");
        $response->ExitScript();
    break;
}
?>