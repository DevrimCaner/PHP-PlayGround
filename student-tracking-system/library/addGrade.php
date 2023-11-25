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
$type = isset($_POST['type']) ? $_POST['type'] : null;
$grade = isset($_POST['grade']) ? $_POST['grade'] : null;

//Controls
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
$query = $db->prepare('INSERT INTO grades SET 
    student = ?,
    course = ?,
    type = ?,
    grade = ?');
$add = $query->execute([
    $student, $course, $type, $grade
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