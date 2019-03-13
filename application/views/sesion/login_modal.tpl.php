<div class="">
    <div id="login-modal" class="modal fade">
        <div class="modal-dialog modal-login">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="avatar">
                        <img src="<?php echo asset_url() . 'img/login/avatar.png'; ?>" alt="Avatar">
                    </div>				
                    <h4 class="modal-title"><?php echo $texts['formulario']['titulo_iniciar_sesion']; ?></h4>	
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <?php echo form_open('inicio/index', array('id' => 'session_form', 'autocomplete' => 'off')); ?>
                    <div class="sign-in-htm">
                        <div class="form-group">
                            <input id="usuario" name="usuario" type="text" class="form-control" placeholder="<?php echo $texts['formulario']['user']; ?>:">

                        </div>
                        <?php
                        echo form_error_format('usuario');
                        if ($this->session->flashdata('flash_usuario')) {
                            ?>
                            <div class="alert alert-danger" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <?php echo $this->session->flashdata('flash_usuario');
                                ?>
                            </div>
                            <?php
                        }
                        ?>
                        <div class="form-group">
                            <input id="password"
                                   name="password"
                                   type="password"
                                   class="form-control"
                                   data-type="password"
                                   placeholder="<?php echo $texts['formulario']['passwd']; ?>:">
                        </div>
                        <?php
                        echo form_error_format('password');
                        if ($this->session->flashdata('flash_password')) {
                            ?>

                            <div class="alert alert-danger" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <?php echo $this->session->flashdata('flash_password'); ?>
                            </div>
                            <?php
                        }
                        ?>
                        <div class="form-group" style="text-align:center;">
                            <input id="captcha"
                                   name="captcha"
                                   type="text"
                                   class="form-control "
                                   placeholder="<?php echo $texts['formulario']['captcha']; ?>">
                                   <?php
                                   echo form_error_format('captcha');
                                   ?>
                            <br>
                            <div class="captcha-container" id="captcha_first">
                                <img id="captcha_img" src="<?php echo site_url(); ?>/inicio/captcha" alt="CAPTCHA Image" />
                                <a class="btn btn-lg btn-success pull-right" onclick="new_captcha()">
                                    <span class="glyphicon glyphicon-refresh"></span>
                                </a>
                            </div>
                        </div>
                        <br>
                        <div class="">
                            <input type="submit" class="btn btn-primary btn-lg btn-block login-btn" value="Iniciar sesión">
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#">Forgot Password?</a>
                </div>
            </div>
        </div>
    </div> 
</div>
<script>
<?php
if (isset($errores)) {
    ?>
        $('#login-modal').modal({show: true});
    <?php
}
?>
</script>