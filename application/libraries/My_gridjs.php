<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Clase que contiene métodos para la carga de la plantilla base del sistema y creación de la paginación
 * @version 	: 1.1.0
 * @author 	: LEAS
 * @property    : mixed[] Data arreglo de datos de plantilla con la siguisnte estructura array("title"=>null,"nav"=>null,"main_title"=>null,"main_content"=>null);
 * */
class My_gridjs {

    private $elementos;
    private $assets;
    private $config_grid;
    private $atributos_model;
    private $controller;

    const NAME_GRID = "name_grid",
            FUNCIONES_ACTIVAS = "funciones",
            URL_EJECUCION = "url_ejecucion",
            GET = "GET",
            INSERTAR = "POST",
            ACUALIZAR = "PUT",
            ELIMINAR = "DELETE",
            CATALOGOS = "catalogos"

    ;

    public function __construct() {
        $this->init();
    }

    private function init() {
        $this->CI = & get_instance();
        $this->controller = $this->CI->uri->rsegment(1);
        $this->setController($this->controller);
//        $accion = $this->CI->uri->rsegment(2);
//        $url = $this->CI->uri->uri_string;
//        pr($this->CI->uri->rsegment(1));
        $this->config_grid = [
            My_gridjs::NAME_GRID => 'jsGrid',
            My_gridjs::FUNCIONES_ACTIVAS => [
                My_gridjs::GET => ['url' => ($this->controller . '/get'), 'funcion' => 'loadData'],
                My_gridjs::INSERTAR => ['url' => ($this->controller . '/insertar'), 'funcion' => 'insertItem'],
                My_gridjs::ACUALIZAR => ['url' => ($this->controller . '/actualizar'), 'funcion' => 'updateItem'],
                My_gridjs::ELIMINAR => ['url' => ($this->controller . '/delete'), 'funcion' => 'deleteItem']
//                My_gridjs::GET => ['url' => ($this->controller . '/accion'), 'funcion' => 'loadData'],
//                My_gridjs::INSERTAR => ['url' => ($this->controller . '/accion'), 'funcion' => 'insertItem'],
//                My_gridjs::ACUALIZAR => ['url' => ($this->controller . '/accion'), 'funcion' => 'updateItem'],
//                My_gridjs::ELIMINAR => ['url' => ($this->controller . '/accion'), 'funcion' => 'deleteItem'],
            ],
            My_gridjs::CATALOGOS => ['url' => ($this->controller . '/catalogos')]
        ];
        $this->assets = [
            'css' => array(
                css('jsgrid.css', 'all', 'css_gridjs_url'),
                css('jsgrid-theme.css', 'all', 'css_gridjs_url')
            ),
            'js' => array(
                js('jsgrid.js', array(), 'jsgrid_url'),
            ),
            'cssmin' => array(
                css('jsgrid.min.css', 'all', 'css_gridjs_url'),
                css('jsgrid-theme.min.css', 'all', 'css_gridjs_url')
            ),
            'jsmin' => array(js('jsgrid.min.js', array(), 'jsgrid_url')),
        ];
        $this->atributos_model = array();
        $this->elementos = [
            "css" => $this->assets['cssmin'],
            "js" => $this->assets['jsmin'],
            "control_js" => array(js('tools/control_jsgrid.js')),
//            "control_js" => array(js('tools/sample.js')),
            "config_grid" => $this->config_grid,
            "data" => null,
            "column" => null,
            "url_controller" => array(),
        ];
    }

    public function get_template($view = "jsgrid/default.tpl.php") {
        $result = $this->CI->load->view($view, $this->elementos, true);
        return $result;
    }

    public function set_url_controler($url_controler = array("update,insert,get,delete")) {
        
    }

    function getElementos() {
        return $this->elementos;
    }

    function setElementos($elementos) {
        $this->elementos = $elementos;
    }

    function setData($data) {
        $this->elementos['data'] = $data;
    }

    function setUrl_controller($field, $value = null) {
        if (is_array($field)) {
            $this->elementos['url_controller'] = $field;
        } else {
            $this->elementos['url_controller'][$field] = $value;
        }
    }

    function getController() {
        return $this->controller;
    }

    function setController($controller) {
        $this->controller = $controller;
    }

    function setColumns($field, $value = null) {
        if (is_array($field)) {
            $this->elementos['column'] = $field;
        } else {
            if (is_null($field)) {
                $this->elementos['column'][] = $value;
            } else {
                $this->elementos['column'][$field] = $value;
            }
        }
    }

    function setJs($min = true) {
        $this->elementos['js'] = ($min) ? $this->assets['jsmin'] : $this->assets['js'];
    }

    function setCss($min = true) {
        $this->elementos['css'] = ($min) ? $this->assets['cssmin'] : $this->assets['css'];
    }

    function setConfigGrid($field, $value = null) {
        if (is_array($field)) {
            $this->elementos['config_grid'] = $field;
        } else {
            $this->elementos['config_grid'][$field] = $value;
        }
    }

    function setNameGrid($nameGrid = 'jsgrid') {
        $this->elementos['config_grid'][My_gridjs::NAME_GRID] = $nameGrid;
    }

    function setfuncionesOperacion($type = My_gridjs::GET, $url) {
        $this->elementos['config_grid'][My_gridjs::FUNCIONES_ACTIVAS][$type] = $url;
    }

    function setCatalogos($catalogos) {
        $this->elementos['config_grid'][My_gridjs::CATALOGOS] = $catalogos;
    }

}
