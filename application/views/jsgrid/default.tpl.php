<?php
foreach ($css as $value) {//Carga los css
    echo $value;
}
foreach ((array_merge($js, $control_js)) as $value) {//Carga los js
    echo $value;
}
?>

<script>
    var config_grid = <?php echo json_encode($config_grid); ?>;
    var column = <?php echo json_encode($column); ?>;
</script>

<div id="<?php echo $config_grid[My_gridjs::NAME_GRID]; ?>"></div>