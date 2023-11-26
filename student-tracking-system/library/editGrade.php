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
$visa = isset($_POST['visa']) ? $_POST['visa'] : null;
$final = isset($_POST['final']) ? $_POST['final'] : null;

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
if(!$visa){
    $response['message'] = 'Tür verisi boş olamaz';
    return Response($response);
}
if(!$final){
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
if(!is_int($visa)){
    $response['message'] = 'Hatalı Tür verisi';
    return Response($response);
}
if($visa < 0 && $visa > 100){
    $response['message'] = 'Vize Notu 0 ile 100 arasında olmalıdır.';
    return Response($response);
}
if(!is_int($final)){
    $response['message'] = 'Hatalı Not verisi';
    return Response($response);
}
if($final < 0 && $final > 100){
    $response['message'] = 'Final Notu 0 ile 100 arasında olmalıdır.';
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
$query = $db->prepare('UPDATE grades SET 
    student = ?,
    course = ?,
    visa = ?,
    final = ?
    WHERE id = ?');
$update = $query->execute([
    $student, $course, $visa, $final, $updateId
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