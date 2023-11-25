<?php
include_once 'db.php';
$response = [
    'status' => 'error',
    'message' => ''
];

if(!$_POST){
    $response['message'] = 'Herhangi bir veri bulunamadı';
    return Response($response);
}
//Get Data
$name = isset($_POST['name']) ? htmlspecialchars(trim($_POST['name'])) : null;

//Controls
if(!$name){
    $response['message'] = 'Ders İsimi bölümü boş olamaz';
    return Response($response);
}

//DataBase
$query = $db->prepare('INSERT INTO courses SET 
    name = ?');
$add = $query->execute([
    $name
]);
if (!$add){
    $response['message'] = 'Kayıt ekleme sırasında hata oluştu';
    return Response($response);
}
else{
    $response['status'] = 'success';
    $response['message'] = 'Kayıt ekleme başarılı';
    return Response($response);
}
?>