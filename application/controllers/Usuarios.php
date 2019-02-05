<?php

/*
 * * Clase Inicio.
 */

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Inicio
 *
 * @author chrigarc
 */
class Usuarios extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $usuario = $this->session->userdata('ingenia');
        $this->template->setMainContent('Listado de usuarios');
        $this->template->getTemplate();
    }

    public function inicio() {
        $this->template->setTitle('Inicio');
        $main_content = $this->load->view('sesion/index.tpl.php', [], true);
        $this->template->setMainContent($main_content);
        $this->template->getTemplate();
    }

    function captcha() {
        new_captcha();
    }

    public function cerrar_sesion() {
        $this->session->sess_destroy();
        redirect(site_url());
    }

}
