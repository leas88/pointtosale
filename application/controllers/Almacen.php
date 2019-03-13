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
        $this->load->model('Catalogos_generales', 'catgen');
    }

    public function listado() {
        /*
         * Configuración del grid JS
         */
        $this->load->library('My_gridjs');
//        pr($texts);
        $this->my_gridjs->setCss(false);
        $this->my_gridjs->setJs(false);
        $this->my_gridjs->setControlGrid([js('tools/control_jsgrid.js')]); //Agrega archivos de control que se ocupen para el manejo del JS
        $column = [
            ['name' => 'nombre_almacen', 'title' => 'Almacen', 'type' => 'text', 'width' => 150, "filtering" => true],
            ["name" => "cve_almacen", "title" => "Clave del almacen", "type" => "text", "width" => 50, "filtering" => true],
            ["name" => "calle", "title" => "Calle", "type" => "text", "width" => 50, "filtering" => true],
            ["name" => "num_ext", "title" => "N. Ext.", "type" => "text", "width" => 50, "filtering" => true],
            ['type' => 'control']
        ];
//        $my_grid->setColumns(null, ['name'=>'country_id', 'title'=>'Ciudad', 'type' => 'select', 'width'=> 150, 'items'=> '{{countries}}', 'valueField'=>'id', 'textField'=>"name"]);
        $this->my_gridjs->setColumns($column);
//        $my_grid->setColumns(null, ['name' => 'country_id', 'title' => 'Ciudad', 'type' => 'select', 'width' => 150, 'items' => "countries", 'valueField' => 'id', 'textField' => "name"]);
        $content = $this->my_gridjs->get_template();
//        pr($content);


        $this->template->setTitle('Almacen');
        $this->template->setMainContent($content);
        $this->template->getTemplate();
    }

    public function get() {
//        $result = [];
        $param["select"] = ["id_almacen", "nombre_almacen", "cve_almacen", "latitud", "longitud", "calle", "num_ext", "num_int", "almacen_padre"];
        $result['data'] = $this->catgen->getConsutasGenerales('app_almacen', $param["select"], null, null, 2);
        header("Content-Type: application/json");
        echo json_encode($result);
    }

    public function insertar() {
        $texts = get_elementos_lenguaje([EnGen::LANG_CRUD]);
        if ($this->input->post()) {
            $dataPost = $this->input->post(null, true);
            $result = $this->catgen->insert_registro_general('app_almacen', $dataPost, $texts, 'id_almacen');
        } else {
            $result = [EnGen::KEYRESP_JSON => EnGen::RESP_DANGER, EnGen::KEYRESP_MESSAJE => $texts['msj_danger']];
        }
        header("Content-Type: application/json");
        echo json_encode($result);
    }

    public function actualizar() {
        $texts = get_elementos_lenguaje([EnGen::LANG_CRUD]);
        if ($this->input->post()) {
            $dataPost = $this->input->post(null, true);
            if (isset($dataPost['almacen_padre']) && empty($dataPost['almacen_padre'])) {
                $dataPost['almacen_padre'] = null;
            }
            $where = ['id_almacen' => $dataPost['id_almacen']];
            $result = $this->catgen->update_registro_general('app_almacen', $dataPost, $where, $texts);
            $result['data'] = $dataPost;
        } else {
            $result = [EnGen::KEYRESP_JSON => EnGen::RESP_DANGER, EnGen::KEYRESP_MESSAJE => $texts['msj_danger']];
        }
        header("Content-Type: application/json");
        echo json_encode($result);
    }

    public function delete() {
        $texts = get_elementos_lenguaje([EnGen::LANG_CRUD]);
//        pr("sss");
        $dataPost = $this->input->post(null, true);
        if ($this->input->post()) {
            if (isset($dataPost['almacen_padre']) && empty($dataPost['almacen_padre'])) {
                $dataPost['almacen_padre'] = null;
            }
            $where = ['id_almacen' => $dataPost['id_almacen']];
            $result = $this->catgen->delete_registro_general('app_almacen', $where, $texts);
//            $result = $dataPost;
        } else {
            $result = [EnGen::KEYRESP_JSON => EnGen::RESP_DANGER, EnGen::KEYRESP_MESSAJE => $texts['msj_danger']];
        }
        header("Content-Type: application/json");
        echo json_encode($result);
    }

    public function accion() {
        $result = [];
        switch ($_SERVER["REQUEST_METHOD"]) {
            case "GET":
//                $result[] = ['name' => 'Luis', 'age' => 78, 'country_id' => 1];
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

    public function catalogos() {
        header("Content-Type: application/json");
        echo json_encode($result);
    }

}
