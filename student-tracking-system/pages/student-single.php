<?php
if(!isset($_GET['student'])){
    echo "<h1>Öğrenci Bilgisi Eksik</h1>";
    return;
}
$studentId = $_GET['student'];
if(!is_numeric($studentId)){
    echo "<h1>Hatalı Öğrenci Bilgisi</h1>";
    return;
}
$record = $db->query("SELECT * FROM students WHERE id = '{$studentId}'")->fetch(PDO::FETCH_ASSOC);
if(!$record){
    echo "<h1>Öğrenci Bulunamadı</h1>";
    return;
}
?>
<input type="hidden" id="student" value="<?php echo $record['id'];?>">
<section>
    <div class="container">
        <h1>Öğrenci Bilgileri</h1>
        <h2><?php echo $record['firstName'] . ' ' . $record['lastName'];?></h2>
        <h3><?php echo $record['birthDate'];?></h3>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Yeni Not Ekle</button>
        
        <h4>Notlar</h4>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ders Notu Ekle</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                    <div class="mb-3">
                        <label for="course" class="form-label">Ders Seçimi</label>
                        <?php include 'components/selectCourse.php';?>
                    </div>

                    <div class="mb-3">
                        <label for="visa" class="form-label">Vize Notu</label>
                        <input type="number" class="form-control" id="visa" value="0" min="0" max="100" placeholder="Vize Notu">
                    </div>
                    <div class="mb-3">
                        <label for="final" class="form-label">Final Notu</label>
                        <input type="number" class="form-control" id="final" value="0" min="0" max="100" placeholder="Final Notu">
                    </div>
                    <div class="mb-3">
                        <label for="average" class="form-label">Not Ortalaması</label>
                        <input type="number" class="form-control" id="average" value="0" min="0" max="100" aria-label="Not Ortalaması" readonly>
                    </div>

                    <div id="infoDivAllertMessage">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
                    <button type="button" class="btn btn-primary" id="addButton" onclick="ADDGrade()">Ekle</button>
                </div>
                </div>
            </div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Ders</th>
                    <th scope="col">Vize</th>
                    <th scope="col">Final</th>
                    <th scope="col">Ortalama</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
            <?php
            $table = $db->query("SELECT *, ((visa * 0.4) + (final * 0.6)) AS average FROM grades JOIN courses ON grades.course = courses.id WHERE student = {$studentId}")->fetchAll(PDO::FETCH_ASSOC);
            foreach($table as $row){
            ?>
                <tr>
                    <td><?php echo $row['name'];?></td>
                    <td><?php echo $row['visa'];?></td>
                    <td><?php echo $row['final'];?></td>
                    <td><?php echo $row['average'];?></td>
                    <td>
                        <button type="button" style="display:none" class="btn btn-info btn-sm" onclick="EDIT(<?php echo $row['id'];?>)" id="editButton<?php echo $row['id'];?>">Değiştir</button>
                        <!--
                        <button type="button" class="btn btn-primary btn-sm" onclick="EditOn(<?php echo $row['id'];?>)" id="editOnButton<?php echo $row['id'];?>">Düzenle</button>
                        -->
                        <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete<?php echo $row['id'];?>"> Sil </button>
                    </td>
                </tr>
                <!-- Grade Delete Modal -->
                <div class="modal fade" id="delete<?php echo $row['id'];?>" tabindex="-1">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title">Ders Silme</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <?php echo $record['firstName'] . ' ' . $record['lastName'];?> öğrencisinin <?php echo $row['name'];?> Notu silmek istedğinize emin misniz ?
                        <p>
                            <div id="deleteInfoDiv<?php echo $row['id'];?>"></div>
                        </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
                            <button type="button" class="btn btn-danger" onclick="DELETE(<?php echo $row['id'];?>)" id="deleteButton<?php echo $row['id'];?>">Sil</button>
                        </div>
                    </div>
                    </div>
                </div>
                <!--End Grade Delete Modal-->

            <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</section>