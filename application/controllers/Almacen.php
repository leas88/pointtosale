<?php

/*
 * * Clase Inicio.
 */

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Inicio
 *
 * @author leas
 */
class Almacen extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function listado() {
        /*
         * Configuración del grid JS
         */
        $this->load->library('My_gridjs');
        $my_grid = new my_gridjs();
//        $config_grid = array(My_gridjs::NAME_GRID => 'almacen_grid');
//        $my_grid->setConfigGrid($config_grid);
        $my_grid->setColumns(null, ['name' => 'name', 'title' => 'Nombre', 'type' => 'text', 'width' => 150]);
        $my_grid->setColumns(null, ["name" => "age", "title" => "Age", "type" => "number", "width" => 50, "filtering" => false]);
//        $my_grid->setColumns(null, ['name'=>'country_id', 'title'=>'Ciudad', 'type' => 'select', 'width'=> 150, 'items'=> '{{countries}}', 'valueField'=>'id', 'textField'=>"name"]);
        $my_grid->setColumns(null, ['name' => 'country_id', 'title' => 'Ciudad', 'type' => 'select', 'width' => 150, 'items' => "countries", 'valueField' => 'id', 'textField' => "name"]);
        $my_grid->setColumns(null, ['type' => 'control']);
        $content = $my_grid->get_template();
//        pr($content);


        $this->template->setTitle('Almacen');
        $this->template->setMainContent($content);
        $this->template->getTemplate();
    }

    public function accion() {
        $result = [];
        switch ($_SERVER["REQUEST_METHOD"]) {
            case "GET":

                break;

            case "POST":
                break;

            case "PUT":
                parse_str(file_get_contents("php://input"), $_PUT);

                break;

            case "DELETE":
                parse_str(file_get_contents("php://input"), $_DELETE);

                break;
        }

        header("Content-Type: application/json");
        echo json_encode($result);
    }

}
