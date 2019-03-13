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
        $this->load->library('EnGen');

        $usuario = $this->get_datos_sesion(En_datos_sesion::ID_USER); //Identificador del usuario
        $this->load->model('Menu_model', 'menu');
        if (!is_null($usuario)) {
            $accesos = $this->menu->get_modulos_acceso($usuario); //Obtiene el menu o los niveles de acceso
        } else {
            $accesos = $this->menu->get_modulos_acceso(null); //Obtiene el menu o los niveles de acceso
//            $menu = $this->menu->get_modulos_acceso(null); //Obtiene el menu 
        }
//        pr($usuario);
        $this->niveles_acceso->setModulos($accesos);

        $config_extra = $this->menu->get_config_extra_modulos($this->niveles_acceso->getCvesModulosAcceso()); //Las claves de los modulos que tienen acceso al sistema
        $this->niveles_acceso->setGeneraConfiguaracionExtra($config_extra);//Genera el formato de la configuración extra de los permisos para cada modulo
//        pr($this->niveles_acceso->getConfiguaracionExtra());
        $this->template->setMenu($this->niveles_acceso->getMenu()); //Asigna y obtiene el menu generado
//        pr($accesos);
    }

    /**
     *
     * @param type $busqueda_especifica
     * @return int
     * @obtiene el array de los datos de session
     */
    public function get_datos_sesion($busqueda_especifica = '*') {
        $data_usuario = $this->session->userdata(EnGen::KEYSESION_DATA)[EnGen::KEYSESIONCOMF_USUARIO];
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
