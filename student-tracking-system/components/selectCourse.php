<?php
$options = $db->query("SELECT * FROM courses")->fetchAll(PDO::FETCH_ASSOC);
?>
<select class="form-select rounded-pill border border-primary" aria-label="dersler" id="course">
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