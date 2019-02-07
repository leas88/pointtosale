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
class Persona extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }
    
    public function datos_persona() {

        $this->template->setTitle('Perfiles');
        $this->load->library('Grocery_CRUD');
        $crud = new grocery_CRUD();
        $crud->set_table('catalog_person');
        $crud->columns('name','last_name','mother_lastname','age','sexo','curp','rfc');

        $output = $crud->render();
        $content = $this->load->view('grocery/default.php',$output, true);
        $this->template->setMainContent($content);
        $this->template->getTemplate();
    }

    public function datos_contacto() {

        $this->template->setTitle('Perfiles');
        $this->load->library('Grocery_CRUD');
        $crud = new grocery_CRUD();
        $crud->set_table('catalog_contac');
        $crud->columns('id_person','contacttype','contact','descripcion','activo');
         $crud-> set_relation ('id_person','catalog_person','{name} {last_name} {mother_lastname}');
        $output = $crud->render();
        $content = $this->load->view('grocery/default.php',$output, true);
        $this->template->setMainContent($content);
        $this->template->getTemplate();
    }




}
