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
        $crud->columns('id_rol', 'rolname');

        $output = $crud->render();
        $content = $this->load->view('grocery/default.php',$output, true);
        $this->template->setMainContent($content);
        $this->template->getTemplate();
    }

}
