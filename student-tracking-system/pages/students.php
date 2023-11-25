<section>
    <div class="container">
        <h1>Öğrenciler</h1>
        <a class="btn btn-primary" href="#" role="button">Yeni Öğrenci Ekle</a>
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
                        <a class="btn btn-primary" href="#" role="button">Görüntüle</a>
                    </td>
                </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</section>