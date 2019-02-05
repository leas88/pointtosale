<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo isset($texts["title"]) ? $texts["title"] . "::" : ""; ?> Ingenia</title>
        <?php echo css('tools/bootstrap.css'); ?>
        <?php echo css('tools/style_login.css'); ?>
        <?php echo js('tools/captcha.js'); ?>
        <script type="text/javascript">
            var url = "<?php echo base_url(); ?>";
            var site_url = "<?php echo site_url(); ?>";
            var img_url_loader = "<?php echo base_url('assets/img/loader.gif'); ?>";
        </script>
        <?php // echo js("jquery.js"); ?>
        <?php echo js("tools/jquery.min.js"); ?>
        <?php echo js("tools/jquery.ui.min.js"); ?>
        <?php //echo js('tools/general.js'); ?>
        <?php //echo js("tools/login.js"); ?>
        <?php echo js("tools/bootstrap.js"); ?>
    </head>

    <body>
        <div class="col-md-14">
            <!-- /. NAV TOP  -->
            <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">

                <!-- LLAMAR NAVTOP.PHP -->
                <div class="navbar-header">

                </div>
                <div class="notifications-wrapper">
                    <ul class="nav">
                      
                        <li class="nav pull-right">
                            <ul class="">
                                <li>
                                    <a href="https://ingenia.com/index.html" target="_blank">
                                        <img img-responsive src="<?php echo asset_url(); ?>img/logo_ingenia.png"
                                             height="70px"
                                             class="logos"
                                             alt=""
                                             title=""
                                             target="_blank"/>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>

                </div>


            </nav>
        </div>

    </div>
    <div class="col-md-14 menu">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse" id="myNavbar">
                        <ul class="nav navbar-nav">
                            <li class=""><a href="<?php echo site_url() . '/inicio/inicio'; ?>">INICIO</a></li>
                            <?php
                            //Pinta el menu de modulos
                            if (isset($menu) && !empty($menu)) {//Valida que los módulos existan y no sean nulos 
                                foreach ($menu as $valor) {
                                    if ($valor['tipo_modulo'] == 'MENU') {//Valida que sea un menu, y no una simple acción
                                        ?>
                                        <li><a href="<?php echo site_url() . $valor['url']; ?>"><i class="fa fa-sign-out"></i> <?php echo $valor['nombre_modulo']; ?></a></li>
                                        <?php
                                    }
                                }
                            }
                            ?>
                            <li><a href="<?php echo site_url(); ?>/inicio/cerrar_sesion"><i class="fa fa-sign-out"></i> Cerrar sesión</a></li>
                            <li class="dropdown">
                            <li><a href="#" data-toggle="modal" data-target="#contacto-modal">Contacto</a></li>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <div class="col-md-2"></div>
    </div>
    <div class="col-md-14 text-center container-fluid carousel_background">
        <?php
        echo $main_content;
        ?>
    </div>

    <?php if (isset($my_modal)) {
        ?>
        <?php echo $my_modal; ?>
    <?php } ?>

    <div class="modal fade" id="contacto-modal" tabindex="-1" role="dialog" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="padding:35px 50px;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4><span class="glyphicon glyphicon-lock"></span>Contacto</h4>
                </div>
                <div class="modal-body" style="padding:40px 50px;">
                    <div class="login-page">
                        <p>¿Tienes alguna duda? Comunícate con nosotros:</p>
                        <p><strong>Teléfono:</strong> 55 22 09 00 Ext. 1922<br><strong>You should follow me on twitter:</strong> <a href="https://ingenia.com/index.html">@IngeniaAgency</a><br></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="navbar navbar-fixed-bottom">
        <footer >
            &copy; <a href="#" target="_blank">Ingenia 2019</a>
            <br>
            <div>Este sitio se visualiza correctamente a partir Mozila Firefox 50 y Google Chrome 55.</div>
        </footer>
    </div>
    <script>
<?php
//if (isset($errores))
//{
?>
        // $('#login-modal').modal({show: true});
<?php
//}
?>
    </script>
</body>
</html>
