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
$record = $db->query("SELECT *, TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) AS age FROM students WHERE id = '{$studentId}'")->fetch(PDO::FETCH_ASSOC);
if(!$record){
    echo "<h1>Öğrenci Bulunamadı</h1>";
    return;
}
?>
<input type="hidden" id="student" value="<?php echo $record['id'];?>">
<section class="pt-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <h1 class="text-primary fs-2">Öğrenci Bilgileri</h1>
                <h2 class="text-primary fs-5">Adı : <?php echo $record['firstName'];?></h2>
                <h2 class="text-primary fs-5">Soy Adı : <?php echo $record['lastName'];?></h2>
                <h3 class="text-primary fs-5">Yaş : <?php echo $record['age'];?></h3>
                <h3 class="text-primary fs-5 mb-5">Doğum Tarihi : <?php echo $record['birthDate'];?></h3>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-outline-danger bg-gradient rounded-pill shadow my-5" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="bi bi-trash-fill"></i> Öğrenciyi Sil</button>
                <!-- Student Delete Modal -->
                <div class="modal fade bg-blur bg-danger bg-opacity-25" id="deleteModal" tabindex="-1">
                    <div class="modal-dialog shadow">
                    <div class="modal-content rounded-4">
                        <div class="modal-header">
                        <h5 class="modal-title fs-5 text-primary">Öğrenci Silme</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <span class="text-primary fw-bold"><?php echo $record['firstName'] . ' ' . $record['lastName'];?></span> öğrencisini silmek istedğinize emin misniz ?
                        <p>
                            <div id="deleteInfoDiv"></div>
                        </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary rounded-pill shadow bg-gradient" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i> Vazgeç</button>
                            <button type="button" class="btn btn-danger rounded-pill shadow bg-gradient ms-3" onclick="DELETE(<?php echo $record['id'];?>)" id="deleteButton"><i class="bi bi-trash-fill"></i> Sil</button>
                        </div>
                    </div>
                    </div>
                </div>
                <!--End Student Delete Modal-->
            </div>
            <div class="col-lg-8">

            <?php
            $table = $db->query("SELECT  *, grades.id AS gradeId,((visa * 0.4) + (final * 0.6)) AS average FROM grades JOIN courses ON grades.course = courses.id WHERE student = {$studentId}")->fetchAll(PDO::FETCH_ASSOC);
            if($table){
        ?>
        <h1 class="text-primary fs-2">Notlar <button type="button" class="btn btn-primary bg-gradient rounded-pill shadow" data-bs-toggle="modal" data-bs-target="#addModal"><i class="bi bi-plus-lg"></i> Ekle</button></h1>
        
        <!-- ADD Modal -->
        <div class="modal fade bg-blur" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog shadow">
                <div class="modal-content rounded-4">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-primary" id="addModalLabel">Ders Notu Ekle</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                    <div class="mb-3">
                        <label for="course" class="form-label fs-5 ps-2 text-primary">Ders Seçimi</label>
                        <?php include 'components/selectCourse.php';?>
                    </div>

                    <div class="mb-3">
                        <label for="visa" class="form-label fs-5 ps-2 text-primary">Vize Notu</label>
                        <input type="number" class="form-control rounded-pill border border-primary" id="visa" value="0" min="0" max="100" placeholder="Vize Notu">
                    </div>
                    <div class="mb-3">
                        <label for="final" class="form-label fs-5 ps-2 text-primary">Final Notu</label>
                        <input type="number" class="form-control rounded-pill border border-primary" id="final" value="0" min="0" max="100" placeholder="Final Notu">
                    </div>
                    <div class="mb-3">
                        <label for="average" class="form-labe fs-5 ps-2 text-primary">Not Ortalaması</label>
                        <input type="number" class="form-control rounded-pill border border-secondary" id="average" value="0" min="0" max="100" aria-label="Not Ortalaması" readonly>
                    </div>

                    <div id="infoDivAllertMessage">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary rounded-pill shadow bg-gradient" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i> Vazgeç</button>
                    <button type="button" class="btn btn-primary rounded-pill shadow bg-gradient ms-3" id="addButton" onclick="ADDGrade()"><i class="bi bi-plus-lg"></i> Ekle</button>
                </div>
                </div>
            </div>
        </div>
        <!-- END ADD Modal -->
        <table class="table table-hover shadow mt-4 rounded-4 text-primary">
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
            foreach($table as $row){
            ?>
                <tr>
                    <td><?php echo $row['name'];?></td>
                    <td>
                        <span id="visaText<?php echo $row['gradeId'];?>">
                            <?php echo $row['visa'];?>
                        </span>
                        <input style="display:none" name="visaEdit<?php echo $row['gradeId'];?>" min="0" max="100" type="number" class="form-control rounded-pill border border-primary" id="visaEdit<?php echo $row['gradeId'];?>" value="<?php echo $row['visa'];?>">
                    </td>
                    <td>
                        <span id="finalText<?php echo $row['gradeId'];?>">
                            <?php echo $row['final'];?>
                        </span>
                        <input style="display:none" name="finalEdit<?php echo $row['gradeId'];?>" min="0" max="100" type="number" class="form-control rounded-pill border border-primary" id="finalEdit<?php echo $row['gradeId'];?>" value="<?php echo $row['final'];?>">
                    </td>
                    <td>
                        <span id="averageText<?php echo $row['gradeId'];?>">
                            <?php echo $row['average'];?>
                        </span>
                        <input style="display:none" name="averageEdit<?php echo $row['gradeId'];?>" min="0" max="100" type="number" class="form-control rounded-pill border border-secondary" id="averageEdit<?php echo $row['gradeId'];?>" value="<?php echo $row['average'];?>" readonly>
                    </td>
                    <td class="text-end pe-3">
                        <button type="button" style="display:none" class="btn btn-secondary rounded-pill shadow bg-gradient" onclick="EditOff(<?php echo $row['gradeId'];?>)" id="editOffButton<?php echo $row['gradeId'];?>"><i class="bi bi-x-lg"></i> İptal</button>
                    
                        <button type="button" style="display:none" class="btn btn-success rounded-pill shadow bg-gradient ms-3" onclick="EDITGrade(<?php echo $row['gradeId'];?>)" id="editButton<?php echo $row['gradeId'];?>"><i class="bi bi-check-lg"></i> Değiştir</button>
                        
                        <button type="button" class="btn btn-info rounded-pill text-light bg-gradient shadow" onclick="EditOn(<?php echo $row['gradeId'];?>)" id="editOnButton<?php echo $row['gradeId'];?>"><i class="bi bi-pencil"></i> Düzenle</button>

                        <button type="button" class="btn btn-danger rounded-pill text-light bg-gradient shadow ms-3" data-bs-toggle="modal" data-bs-target="#delete<?php echo $row['gradeId'];?>"><i class="bi bi-trash-fill"></i> Sil </button>
                    </td>
                </tr>
                <!-- Grade Delete Modal -->
                <div class="modal fade bg-blur bg-danger bg-opacity-25" id="delete<?php echo $row['gradeId'];?>" tabindex="-1">
                    <div class="modal-dialog shadow">
                    <div class="modal-content rounded-4">
                        <div class="modal-header">
                        <h5 class="modal-title fs-5 text-primary">Not Silme</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <span class="text-primary fw-bold"><?php echo $record['firstName'] . ' ' . $record['lastName'];?></span> öğrencisinin <span class="text-primary fw-bold"><?php echo $row['name'];?></span> Notunu silmek istedğinize emin misniz ?
                        <p>
                            <div id="deleteInfoDiv<?php echo $row['gradeId'];?>"></div>
                        </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary rounded-pill shadow bg-gradient" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i> İptal</button>
                            <button type="button" class="btn btn-danger rounded-pill shadow bg-gradient ms-3" onclick="DELETEGrade(<?php echo $row['gradeId'];?>)" id="deleteButton<?php echo $row['gradeId'];?>"><i class="bi bi-trash-fill"></i> Sil</button>
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
        <?php
        }
        else{
        ?>
            <h4>Not bilgisi bulunamadı</h4>
        <?php
            }
        ?>

            </div>
        </div>
        
    </div>
</section>