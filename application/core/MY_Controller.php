<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author: LEAS
 * @version: 1.0
 * @desc: Clase padre de los controladores del sistema
 * */
class MY_Controller extends CI_Controller {

    function __construct() {
        parent::__construct();
//        pr('sssss 2');
//        $this->lang->load('interface', 'spanish');
//        $this->load->config('general');
        $this->load->library('niveles_acceso');
        $this->load->library('En_catalogo_textos');

        $usuario = $this->get_datos_sesion(En_datos_sesion::ID_USER); //Identificador del usuario
        if (!is_null($usuario)) {
            $this->load->model('Menu_model', 'menu');
            $accesos = $this->menu->get_modulos_acceso($usuario); //Obtiene el menu o los niveles de acceso
            $this->niveles_acceso->setModulos($accesos);
            $this->template->setMenu($this->niveles_acceso->getMenu()); //Asigna y obtiene el menu generado
        } else {
//            $menu = $this->menu->get_modulos_acceso(null); //Obtiene el menu 
        }
    }

    /**
     *
     * @param type $busqueda_especifica
     * @return int
     * @obtiene el array de los datos de session
     */
    public function get_datos_sesion($busqueda_especifica = '*') {
        $data_usuario = $this->session->userdata('ingenia')['usuario'];
        if ($busqueda_especifica == '*') {
            return $data_usuario;
        } else {
            if (isset($data_usuario[$busqueda_especifica])) {
                return $data_usuario[$busqueda_especifica];
            }
        }
        return NULL; //No se encontro  una llave especifica o la session caduco
    }

}
