<section>
    <div class="container">
        <h1>Dersler</h1>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Yeni Ders Ekle</button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ders Ekle</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Ders Adı</label>
                        <input type="text" class="form-control" id="name" placeholder="Ders Adı">
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

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Ders Numarası</th>
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
                    <th><?php echo $row['id'];?></th>
                    <td>
                        <span id="text<?php echo $row['id'];?>">
                            <?php echo $row['name'];?>
                        </span>
                        <input style="display:none" name="edit<?php echo $row['id'];?>" maxlength="64" type="text" class="form-control" id="edit<?php echo $row['id'];?>" placeholder="Kategori" value="<?php echo $row['name'];?>">
                    </td>
                    <td>
                        <button type="button" style="display:none" class="btn btn-secondary btn-sm" onclick="EditOff(<?php echo $row['id'];?>)" id="editOffButton<?php echo $row['id'];?>">İptal</button>
                        <button type="button" style="display:none" class="btn btn-info btn-sm" onclick="EDIT(<?php echo $row['id'];?>)" id="editButton<?php echo $row['id'];?>">Değiştir</button>
                        <button type="button" class="btn btn-primary btn-sm" onclick="EditOn(<?php echo $row['id'];?>)" id="editOnButton<?php echo $row['id'];?>">Düzenle</button>
                        
                        <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete<?php echo $row['id'];?>"> Sil </button>
                    </td>
                </tr>
                <!-- Delete Modal -->
                <div class="modal fade" id="delete<?php echo $row['id'];?>" tabindex="-1">
                    <div class="modal-dialog">
                    <div class="modal-content">
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
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
                            <button type="button" class="btn btn-danger" onclick="DELETE(<?php echo $row['id'];?>)" id="deleteButton<?php echo $row['id'];?>">Sil</button>
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