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
        $this->lang->load('interface', 'spanish');
        $this->load->config('general');
        $this->load->helper('form');

        $usuario = $this->get_datos_sesion(En_datos_sesion::ID_USER);
        if (!is_null($usuario)) {
            $this->load->model('Menu_model', 'menu');
            $this->load->model('Usuario_model', 'us');
            $roles_completo = $this->us->get_rol_acceso($usuario); //Obtiene roles del usuario
            $roles = $this->us->get_limpia_array_rol($roles_completo); //Obtiene roles del usuario

            $menu = $this->menu->get_modulos_acceso($roles); //Obtiene el menu 
            $this->template->setMenu($menu); //Asigna el menu
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
