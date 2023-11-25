<section>
    <div class="container">
        <h1>Dersler</h1>
        <a class="btn btn-primary" href="#" role="button">Yeni Ders Ekle</a>
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
                    <td><?php echo $row['name'];?></td>
                    <td>
                        <a class="btn btn-primary" href="#" role="button">Düzenle</a>
                        <a class="btn btn-primary" href="#" role="button">Sil</a>
                    </td>
                </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</section>