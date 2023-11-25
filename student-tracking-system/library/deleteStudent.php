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
$deleteId = isset($_POST['deleteId']) ? $_POST['deleteId'] : null;

//Controls
if(!$deleteId || $deleteId == 0){
    $response['message'] = 'Silme Verisi Hatalı';
    return Response($response);
}
if(!is_numeric($deleteId)){
    $response['message'] = 'Silme ID Hatalı';
    return Response($response);
}

//DataBase
$query = $db->prepare("DELETE FROM students WHERE id = :deleteId");
$delete = $query->execute(array(
    'deleteId' => $deleteId
));
if (!$delete){
    $response['message'] = 'Silme işlemi sırasında hata oluştu';
    return Response($response);
}
else{
    $response['status'] = 'success';
    $response['message'] = 'Silme işlemi başarılı';
    return Response($response);
}
return Response($response);
?>