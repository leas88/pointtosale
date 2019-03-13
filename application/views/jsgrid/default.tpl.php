<!--<link href="http://js-grid.com/css/jsgrid.min.css" rel="stylesheet" />
<link href="http://js-grid.com/css/jsgrid-theme.min.css" rel="stylesheet" />
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="http://js-grid.com/js/jsgrid.min.js"></script>-->
<!--<script type="text/javascript">
    var url = "<?php // echo base_url(); ?>";
    var site_url = "<?php // echo site_url(); ?>";
    var img_url_loader = "<?php // echo base_url('assets/img/loader.gif'); ?>";
</script>-->

<script>
    var config_grid = <?php echo json_encode($config_grid); ?>;
    var column = <?php echo json_encode($column); ?>;
    var textjsgrid = <?php echo json_encode($textjsgrid); ?>;
</script>

<div id="<?php echo $config_grid[My_gridjs::NAME_GRID]; ?>" class="container-fluid"></div>

<?php
foreach ($css as $value) {//Carga los css
    echo $value;
}
foreach ((array_merge($js, $control_js)) as $value) {//Carga los js
    echo $value;
}
?>