<section>
    <div class="container">
        <h1>Öğrenciler</h1>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Yeni Öğrenci Ekle</button>
        <!-- Add Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Öğrenci Ekle</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="firstName" class="form-label">Adı</label>
                        <input type="text" class="form-control" id="firstName" placeholder="Adı">
                    </div>
                    <div class="mb-3">
                        <label for="lastName" class="form-label">Soy Adı</label>
                        <input type="text" class="form-control" id="lastName" placeholder="Soy Adı">
                    </div>
                    <div class="mb-3">
                        <label for="birthDate" class="form-label">Doğum Tarihi</label>
                        <input type="date" class="form-control" id="birthDate" placeholder="Doğum Tarihi">
                    </div>
                    <div id="infoDivAllertMessage">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
                    <button type="button" class="btn btn-primary" id="addButton" onclick="ADD()">Ekle</button>
                </div>
                </div>
            </div>
        </div>
        <!-- End Add Modal -->
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Öğrenci Numarası</th>
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
                    <th><?php echo $row['id'];?></th>
                    <td><?php echo $row['firstName'];?></td>
                    <td><?php echo $row['lastName'];?></td>
                    <td><?php echo $row['age'];?></td>
                    <td>
                        <a class="btn btn-primary" href="index.php?page=student&student=<?php echo $row['id'];?>" role="button">Görüntüle</a>
                    </td>
                </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</section>