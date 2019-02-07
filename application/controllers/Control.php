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
class Control extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }
    
    public function perfil() {
        $this->template->setTitle('Perfiles');
        $this->load->library('Grocery_CRUD');
        $crud = new grocery_CRUD();
        $crud->set_table('system_rol');
        $crud->columns('rolname');
        $output = $crud->render();
        $content = $this->load->view('grocery/default.php',$output, true);
        $this->template->setMainContent($content);
        $this->template->getTemplate();
    }

    
    public function perfil_acceso() {
        $this->template->setTitle('Perfiles Aceesos');
        $this->load->library('Grocery_CRUD');
        $crud = new grocery_CRUD();
        $crud->set_table('system_rol_modulo');
        $crud->columns('cve_modulo', 'id_rol');
        /*Tabla a Relacionar FK - Tabla - Descripcion */
        $crud -> set_relation ('id_rol','system_rol','rolname');
        $output = $crud->render();
        $content = $this->load->view('grocery/perfil_acceso.php',$output, true);
        $this->template->setMainContent($content);
        $this->template->getTemplate();
    }

    public function asignar_perfil() {
        $this->template->setTitle('Perfiles Aceesos');
        $this->load->library('Grocery_CRUD');
        $crud = new grocery_CRUD();
        $crud->set_table('system_user_rol');
        $crud->columns('id_user', 'id_rol');
        
        $crud -> set_relation ('id_user','system_user','username');
        $crud -> set_relation ('id_rol','system_rol','rolname');

        $output = $crud->render();
        $content = $this->load->view('grocery/asignar_perfil.php',$output, true);
        $this->template->setMainContent($content);
        $this->template->getTemplate();
    }

    

}
