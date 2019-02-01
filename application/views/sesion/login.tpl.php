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
        <?php echo js("tools/jquery.min.js"); ?>
        <?php echo js("tools/jquery.ui.min.js"); ?>
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
                            <li class=""><a href="<?php echo site_url(); ?>">INICIO</a></li>
                            <li><a href="#" data-toggle="modal" data-target="#login-modal">INICIO DE SESIÓN</a></li>
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
    <div class="clearfix"></div>
    <div class="carousel_background">
        <div class="col-md-14 text-center container-fluid">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="align-center">
                    <img src="<?php echo asset_url(); ?>img/we_delivered_01.png" alt="Millions of fans and followers" class="weDelivered-img">
                    <img src="<?php echo asset_url(); ?>img/we_delivered_02.png" alt="Thousands of websites" class="weDelivered-img">
                    <img src="<?php echo asset_url(); ?>img/we_delivered_03.png" alt="Dozens of mobile apps" class="weDelivered-img">
                </div>
            </div>

            
            <div class="col-md-2"></div>
        </div>
    </div>
    <div class="clearfix"></div>

    <?php if (isset($my_modal))
    { ?>
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
