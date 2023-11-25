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
$name = isset($_POST['name']) ? htmlspecialchars(trim($_POST['name'])) : null;

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
$checkRecord = $db->query("SELECT * FROM courses WHERE id = '{$updateId}'")->fetch(PDO::FETCH_ASSOC);
if(!$checkRecord){
    $response['message'] = 'Güncellemek istenen kayıt Bulunamadı.';
    return Response($response);
}
if(!$name){
    $response['message'] = 'Ders isimi bölümü boş olamaz';
    return Response($response);
}

//DataBase
$query = $db->prepare('UPDATE courses SET 
name = ?
WHERE id = ?');
$update = $query->execute([
    $name, $updateId
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