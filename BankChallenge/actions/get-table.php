<?php
$tables = ['accounts', 'entries', 'transfers'];
// Get Account Value
$table= isset($_GET['table']) ? $_GET['table'] : null;

// Check is table null
if(!$table){
    $response = new Response("error", "Table cannot be null.");
    $response->Exit();
}
// Is table correct
if(!in_array($table, $tables)){
    $response = new Response("error", "Table not defined.");
    $response->Exit();
}

$database = new Database($db);
// Get Table Data
$select = $database->GetAllRecords($table);
if($select){
    echo json_encode($select);
}
?>