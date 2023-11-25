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
$firstName = isset($_POST['firstName']) ? htmlspecialchars(trim($_POST['firstName'])) : null;
$lastName = isset($_POST['lastName']) ? htmlspecialchars(trim($_POST['lastName'])) : null;
$birthDate = isset($_POST['birthDate']) ? $_POST['birthDate'] : null;

//Controls
if(!$firstName){
    $response['message'] = 'İsim bölümü boş olamaz';
    return Response($response);
}
if(!$lastName){
    $response['message'] = 'Soyisim bölümü boş olamaz';
    return Response($response);
}
if(!$birthDate){
    $response['message'] = 'Doğum bölümü boş olamaz';
    return Response($response);
}

//DataBase
$query = $db->prepare('INSERT INTO students SET 
    firstName = ?,
    lastName = ?,
    birthDate = ?');
$add = $query->execute([
    $firstName, $lastName, $birthDate
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