<section class="pt-4">
    <div class="container">
        <h1 class="text-primary fs-2">Dersler <button type="button" class="btn btn-primary bg-gradient rounded-pill shadow" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi bi-plus-lg"></i> Ekle</button></h1>
        <!-- Button trigger modal -->
        

        <!-- Modal -->
        <div class="modal fade bg-blur" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog shadow">
                <div class="modal-content rounded-4">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ders Ekle</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label fs-5 ps-2 text-primary">Ders Adı</label>
                        <input type="text" class="form-control rounded-pill border border-primary" id="name" placeholder="Ders Adı">
                    </div>
                    <div id="infoDivAllertMessage">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary rounded-pill shadow bg-gradient" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i> İptal</button>
                    <button type="button" class="btn btn-primary rounded-pill shadow bg-gradient ms-3" id="addButton" onclick="ADD()"><i class="bi bi-plus-lg"></i> Ekle</button>
                </div>
                </div>
            </div>
        </div>

        <table class="table table-hover shadow mt-4 rounded-4">
            <thead>
                <tr>
                    <th scope="col">Ders Adı</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
            <?php
            $table = $db->query("SELECT * FROM courses")->fetchAll(PDO::FETCH_ASSOC);
            foreach($table as $row){
            ?>
                <tr>
                    <td>
                        <span id="text<?php echo $row['id'];?>">
                            <?php echo $row['name'];?>
                        </span>
                        <input style="display:none" name="edit<?php echo $row['id'];?>" maxlength="64" type="text" class="form-control rounded-pill border border-primary" id="edit<?php echo $row['id'];?>" placeholder="Kategori" value="<?php echo $row['name'];?>">
                    </td>
                    <td>
                        <button type="button" style="display:none" class="btn btn-secondary rounded-pill shadow bg-gradient" onclick="EditOff(<?php echo $row['id'];?>)" id="editOffButton<?php echo $row['id'];?>"><i class="bi bi-x-lg"></i> İptal</button>
                        <button type="button" style="display:none" class="btn btn-success rounded-pill shadow bg-gradient ms-3" onclick="EDIT(<?php echo $row['id'];?>)" id="editButton<?php echo $row['id'];?>"><i class="bi bi-check-lg"></i> Değiştir</button>
                        <button type="button" class="btn btn-info rounded-pill text-light bg-gradient shadow ms-3" onclick="EditOn(<?php echo $row['id'];?>)" id="editOnButton<?php echo $row['id'];?>"><i class="bi bi-pencil"></i> Düzenle</button>
                        
                        <button type="button" class="btn btn-danger rounded-pill text-light bg-gradient shadow ms-3" data-bs-toggle="modal" data-bs-target="#delete<?php echo $row['id'];?>"><i class="bi bi-trash-fill"></i> Sil </button>
                    </td>
                </tr>
                <!-- Delete Modal -->
                <div class="modal fade bg-blur bg-danger bg-opacity-25 " id="delete<?php echo $row['id'];?>" tabindex="-1">
                    <div class="modal-dialog shadow ">
                    <div class="modal-content rounded-4">
                        <div class="modal-header">
                        <h5 class="modal-title">Ders Silme</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <?php echo $row['name'];?> Dersini silmek istedğinize emin misniz ?
                        <p>
                            <div id="deleteInfoDiv<?php echo $row['id'];?>"></div>
                        </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary rounded-pill shadow bg-gradient" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i> İptal</button>
                            <button type="button" class="btn btn-danger rounded-pill shadow bg-gradient ms-3" onclick="DELETE(<?php echo $row['id'];?>)" id="deleteButton<?php echo $row['id'];?>"><i class="bi bi-trash-fill"></i> Sil</button>
                        </div>
                    </div>
                    </div>
                </div>
                <!-- Delete Modal-->

            <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</section>