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
$student = isset($_POST['student']) ? $_POST['student'] : null;
$course = isset($_POST['course']) ? $_POST['course'] : null;
$visa = isset($_POST['visa']) ? $_POST['visa'] : null;
$final = isset($_POST['final']) ? $_POST['final'] : null;

//Controls
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

if(!is_numeric($student)){
    $response['message'] = 'Hatalı Öğrenci verisi.';
    return Response($response);
}
if(!is_numeric($course)){
    $response['message'] = 'Hatalı Ders verisi';
    return Response($response);
}
if(!is_numeric($visa)){
    $response['message'] = 'Hatalı Tür verisi';
    return Response($response);
}
if($visa < 0 && $visa > 100){
    $response['message'] = 'Vize Notu 0 ile 100 arasında olmalıdır.';
    return Response($response);
}
if(!is_numeric($final)){
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
$query = $db->prepare('INSERT INTO grades SET
    student = ?,
    course = ?,
    visa = ?,
    final = ?');
$add = $query->execute([
    $student, $course, $visa, $final
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