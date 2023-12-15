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
    
    // Undefined Action
    default:
        $response = new Response("error", "Undefined Action.");
        $response->Exit();
    break;
}
?>