<?php
include_once 'config/header.php';
include_once 'library/Response.php';
// Check is Action Defined
if(!isset($_GET['action'])){
    $response = new Response("error", "No Action Defined.");
    $response->Exit();
}
// Import Database Config and Class
include_once 'config/database.php';
include_once 'library/Database.php';
// Action switch
switch($_GET['action']){
    // Creates Account With owner and currency values with zero ballance.
    case 'create-account':
        include_once 'actions/create-account.php';
    break;
    // Makes an entrie for account
    case 'make-entrie':
        include_once 'actions/make-entrie.php';
    break;
    // Makes a transfer between accounts
    case 'make-transfer':
        include_once 'actions/make-transfer.php';
    break;
    // Deletes Account
    case 'delete-account':
        include_once 'actions/delete-account.php';
    break;
    // List Account
    case 'list-accounts':
        include_once 'actions/list-accounts.php';
    break;
    // Get Account By Id
    case 'get-account':
        include_once 'actions/get-account.php';
    break;
    // For Sync between diffrent Databases
    case 'sync-database':
        include_once 'actions/sync-database.php';
    break;
    // For Sync between diffrent Hosts
    case 'sync-hosts':
        include_once 'actions/sync-hosts.php';
    break;
    // Returns the Given table for sync
    case 'get-table':
        include_once 'actions/get-table.php';
    break;


    case 'test':
        $database = new Database($dbHost);
        $insert = $database->InsertRecord('accounts', ['id' => 3, 'owner' => 'Test', 'currency' => 'TRY', 'created_at' => '2022-12-14 21:47:52']);
        // Response
        if($insert){
            $response = new Response("success", "Account Created Successfully.");
            $response->Exit();
        }
        else{
            $response = new Response("error", "There is an error while creating account, please try again later.");
            $response->Exit();
        }
    break;
    
    // Undefined Action
    default:
        $response = new Response("error", "Undefined Action.");
        $response->Exit();
    break;
}
?>