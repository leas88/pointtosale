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
class Modulos extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }
    
    public function grupos() {

        $this->template->setTitle('Perfiles');
        $this->load->library('Grocery_CRUD');
        $crud = new grocery_CRUD();
        $crud->set_table('system_module_group');
        $crud->columns('cve_modulegroup', 'name', 'description', 'active', 'orden');

        $output = $crud->render();
        $content = $this->load->view('sistema/grupos.php',$output, true);
        $this->template->setMainContent($content);
        $this->template->getTemplate();
    }


    public function listado() {

        $this->template->setTitle('Perfiles');
        $this->load->library('Grocery_CRUD');
        $crud = new grocery_CRUD();
        $crud->set_table('system_modulo');
        $crud->columns('cve_module','modulename','active','url','id_moduletype','module_pather','config_json','orden','cve_modulegroup','icon');
        
        $output = $crud->render();
        $content = $this->load->view('sistema/listado.php',$output, true);
        $this->template->setMainContent($content);
        $this->template->getTemplate();
    }

    public function acceso_usuarios() {

        $this->template->setTitle('Perfiles');
        $this->load->library('Grocery_CRUD');
        $crud = new grocery_CRUD();
        $crud->set_table('system_user_modulo');
        $crud->columns('id_user','cve_modulo','acceso');
        
        $output = $crud->render();
        $content = $this->load->view('sistema/acceso_usuarios.php',$output, true);
        $this->template->setMainContent($content);
        $this->template->getTemplate();
    }

    public function definir_modulo() {

        $this->template->setTitle('Definir Tipo Modulo');
        $this->load->library('Grocery_CRUD');
        $crud = new grocery_CRUD();
        $crud->set_table('system_module_type');
        $crud->columns('id_moduletype','name','description','active');
         
        $output = $crud->render();
        $content = $this->load->view('sistema/definir_modulo.php',$output, true);
        $this->template->setMainContent($content);
        $this->template->getTemplate();
    }






}
