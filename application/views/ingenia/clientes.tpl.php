<link href="<?php echo base_url('assets/js/third-party/jsgrid-1.5.3/dist/jsgrid.min.css'); ?>" rel="stylesheet" />
<link href="<?php echo base_url('assets/js/third-party/jsgrid-1.5.3/dist/jsgrid-theme.min.css'); ?>" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/js/third-party/jsgrid-1.5.3/dist/jsgrid.js"></script>
<?php echo js("tools/complemento_jsgrid.js"); ?>
<?php echo js('app/ctl_clientes.js'); ?>

<div class="card-content">
    <h2 class="page-head-line">Listado de clientes: <br>
    </h2>
    <p> 
        En esta sección se listan y registran los clientes, permitiendo saber su numero de tarjeta de credito
    </p>
    <div id="grid_clientes"></div>
</div>

<style type="text/css">
    .id_hide{
        display:none;
    }
</style>