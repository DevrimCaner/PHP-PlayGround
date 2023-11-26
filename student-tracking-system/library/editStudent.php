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
$updateId = isset($_POST['updateId']) ? $_POST['updateId'] : null;
$firstName = isset($_POST['firstName']) ? htmlspecialchars(trim($_POST['firstName'])) : null;
$lastName = isset($_POST['lastName']) ? htmlspecialchars(trim($_POST['lastName'])) : null;
$birthDate = isset($_POST['birthDate']) ? $_POST['birthDate'] : null;

//Controls
if(!$updateId || $updateId == 0){
    $response['message'] = 'Güncelleme Verisi Hatalı';
    return Response($response);
}
if(!is_numeric($updateId)){
    $response['message'] = 'Güncelleme ID Hatalı';
    return Response($response);
}
//Does record exist ?
$checkRecord = $db->query("SELECT * FROM students WHERE id = '{$updateId}'")->fetch(PDO::FETCH_ASSOC);
if(!$checkRecord){
    $response['message'] = 'Güncellemek istenen kayıt Bulunamadı.';
    return Response($response);
}
if(!$firstName){
    $response['message'] = 'İsim bölümü boş olamaz';
    return Response($response);
}
if(!$lastName){
    $response['message'] = 'Soyisim bölümü boş olamaz';
    return Response($response);
}
if(!$birthDate){
    $response['message'] = 'Doğum Tarihi bölümü boş olamaz';
    return Response($response);
}

//DataBase
$query = $db->prepare('UPDATE students SET 
firstName = ?,
lastName = ?,
birthDate = ?
WHERE id = ?');
$update = $query->execute([
    $firstName, $lastName, $birthDate, $updateId
]);
if ($update){
    $response['status'] = 'success';
    $response['message'] = 'Güncelleme Başarılı';
    return Response($response);
}else{
    $response['message'] = 'Güncelleme Sırasında Hata Oluştu';
    return Response($response);
}
?>