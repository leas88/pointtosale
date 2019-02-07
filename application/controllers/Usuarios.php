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
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('Grocery_CRUD');
        $crud = new grocery_CRUD();
        $crud->set_table('system_rol');
        $crud->columns('rolname');

        $output = $crud->render();
        $content = $this->load->view('grocery/default.php',$output, true);
        $this->template->setMainContent($content);
        $this->template->getTemplate();
    }

    public function datos_usuario() {
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('Grocery_CRUD');
        $crud = new grocery_CRUD();
        $crud->set_table('system_user');
        $crud->columns('username','activo','email','token','id_person');
        $crud-> set_relation ('id_person','catalog_person','{name} {last_name} {mother_lastname}');
        $output = $crud->render();
        $content = $this->load->view('grocery/datos_usuario.php',$output, true);
        $this->template->setMainContent($content);
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




