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
if(!$visa){
    $response['message'] = 'Vize verisi boş olamaz';
    return Response($response);
}
if(!$final){
    $response['message'] = 'Final verisi boş olamaz';
    return Response($response);
}

if(!is_numeric($visa)){
    $response['message'] = 'Hatalı Vize verisi';
    return Response($response);
}
if($visa < 0 && $visa > 100){
    $response['message'] = 'Vize Notu 0 ile 100 arasında olmalıdır.';
    return Response($response);
}
if(!is_numeric($final)){
    $response['message'] = 'Hatalı Final verisi';
    return Response($response);
}
if($final < 0 && $final > 100){
    $response['message'] = 'Final Notu 0 ile 100 arasında olmalıdır.';
    return Response($response);
}

//DataBase
$query = $db->prepare('UPDATE grades SET
    visa = ?,
    final = ?
    WHERE id = ?');
$update = $query->execute([
    $visa, $final, $updateId
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