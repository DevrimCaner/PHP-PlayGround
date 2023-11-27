<section class="pt-4">
    <div class="container">
        <h1 class="text-primary fs-2">Öğrenciler <button type="button" class="btn btn-primary bg-gradient rounded-pill shadow" data-bs-toggle="modal" data-bs-target="#addModal"><i class="bi bi-plus-lg"></i> Ekle</button></h1>
        <!-- Button trigger modal -->
        
        <!-- Add Modal -->
        <div class="modal fade bg-blur" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog shadow">
                <div class="modal-content rounded-4">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-primary" id="addModalLabel">Öğrenci Ekle</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="firstName" class="form-label fs-5 ps-2 text-primary">Adı</label>
                        <input type="text" class="form-control rounded-pill border border-primary" id="firstName" placeholder="Adı">
                    </div>
                    <div class="mb-3">
                        <label for="lastName" class="form-label fs-5 ps-2 text-primary">Soy Adı</label>
                        <input type="text" class="form-control rounded-pill border border-primary" id="lastName" placeholder="Soy Adı">
                    </div>
                    <div class="mb-3">
                        <label for="birthDate" class="form-label fs-5 ps-2 text-primary">Doğum Tarihi</label>
                        <input type="date" class="form-control rounded-pill border border-primary" id="birthDate" placeholder="Doğum Tarihi">
                    </div>
                    <div id="infoDivAllertMessage">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary rounded-pill shadow bg-gradient" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i> İptal</button>
                    <button type="button" class="btn btn-primary rounded-pill shadow bg-gradient ms-3" id="addButton" onclick="ADDGrade()"><i class="bi bi-plus-lg"></i> Ekle</button>
                </div>
                </div>
            </div>
        </div>
        <!-- End Add Modal -->
        <table class="table table-hover shadow mt-4 rounded-4 text-primary">
            <thead>
                <tr>
                    <th scope="col">Adı</th>
                    <th scope="col">Soy Adı</th>
                    <th scope="col">Yaş</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
            <?php
            $table = $db->query("SELECT *,  TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) AS age FROM students")->fetchAll(PDO::FETCH_ASSOC);
            foreach($table as $row){
            ?>
                <tr>
                    <td><?php echo $row['firstName'];?></td>
                    <td><?php echo $row['lastName'];?></td>
                    <td><?php echo $row['age'];?></td>
                    <td class="text-end pe-3">
                        <a class="btn btn-info rounded-pill text-light bg-gradient shadow" href="index.php?page=student&student=<?php echo $row['id'];?>" role="button"><i class="bi bi-search"></i> Görüntüle</a>
                    </td>
                </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</section>