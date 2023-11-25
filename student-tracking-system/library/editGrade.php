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
$student = isset($_POST['student']) ? $_POST['student'] : null;
$course = isset($_POST['course']) ? $_POST['course'] : null;
$type = isset($_POST['type']) ? $_POST['type'] : null;
$grade = isset($_POST['grade']) ? $_POST['grade'] : null;

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
$checkRecord = $db->query("SELECT * FROM grades WHERE id = '{$updateId}'")->fetch(PDO::FETCH_ASSOC);
if(!$checkRecord){
    $response['message'] = 'Güncellemek istenen kayıt Bulunamadı.';
    return Response($response);
}
if(!$student){
    $response['message'] = 'Öğrenci verisi boş olamaz';
    return Response($response);
}
if(!$course){
    $response['message'] = 'Ders verisi boş olamaz';
    return Response($response);
}
if(!$type){
    $response['message'] = 'Tür verisi boş olamaz';
    return Response($response);
}
if(!$grade){
    $response['message'] = 'Not verisi boş olamaz';
    return Response($response);
}

if(!is_int($student)){
    $response['message'] = 'Hatalı Öğrenci verisi.';
    return Response($response);
}
if(!is_int($course)){
    $response['message'] = 'Hatalı Ders verisi';
    return Response($response);
}
if(!is_int($type)){
    $response['message'] = 'Hatalı Tür verisi';
    return Response($response);
}
if(!is_int($grade)){
    $response['message'] = 'Hatalı Not verisi';
    return Response($response);
}
if($grade < 0 && $grade > 100){
    $response['message'] = 'Not 0 ile 100 arasında olmalıdır.';
    return Response($response);
}
//Does student exist ?
$checkStudent = $db->query("SELECT * FROM students WHERE id = '{$student}'")->fetch(PDO::FETCH_ASSOC);
if(!$checkStudent){
    $response['message'] = 'Öğrenci Bulunamadı.';
    return Response($response);
}
//Does course exist ?
$checkCourse = $db->query("SELECT * FROM courses WHERE id = '{$course}'")->fetch(PDO::FETCH_ASSOC);
if(!$checkCourse){
    $response['message'] = 'Ders Bulunamadı.';
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