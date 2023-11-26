<?php
$options = $db->query("SELECT * FROM courses")->fetchAll(PDO::FETCH_ASSOC);
?>
<select class="form-select" aria-label="dersler" id="course">
    <option value="0">Belirtilmemiş</option>
    <?php
    foreach($options as $option){
    ?>
        <option value="<?php echo $option['id']; ?>">
            <?php echo $option['name']; ?>
        </option>
    <?php
    }
    ?>
</select>