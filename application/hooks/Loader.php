<?php

/*
 * Cuando escribí esto sólo Dios y yo sabíamos lo que hace.
 * Ahora, sólo Dios sabe.
 * Lo siento.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of HBitacora
 *
 * @author chrigarc
 */
class Loader {

    private static $libre_acceso = array(
        'inicio/index', 'inicio/captcha', 'inicio/cerrar_sesion', 'ayuda/get'
    );

    function load() {
        $this->acceso();
    }

    private function acceso() {
        $CI = & get_instance(); //Obtiene la insatancia del super objeto en codeigniter para su uso directo
//        echo $CI->load->view('template/sin_acceso', $datos_, true);
//        return json_encode($array_result);
        $CI->load->helper('url');
        $CI->load->library('session');

        $controlador = $CI->uri->rsegment(1);  //Controlador actual o dirección actual
        $accion = $CI->uri->rsegment(2);  //Función que se llama en el controlador

        $url = $controlador . '/' . $accion;

        if (!in_array($url, Loader::$libre_acceso)) { //cambiar para localizar modulos de libre acceso como login
            $ingenia = $CI->session->userdata('ingenia');

            if (!is_null($ingenia) && isset($ingenia['usuario'][En_datos_sesion::ID_USER])) {
                $usuario = $ingenia['usuario'][En_datos_sesion::ID_USER];
                if (!$this->verifica_permiso($CI, $usuario)) {
                    redirect(site_url());
                }
            } else {
                redirect(site_url());
            }
        }
    }

    private function verifica_permiso($CI, $id_usuario) {
        $controlador = $CI->uri->rsegment(1);  //Controlador actual o dirección actual
        $accion = $CI->uri->rsegment(2);  //Función que se llama en el controlador
        $url = '/' . $controlador . '/' . $accion;

        $CI->load->model('Menu_model', 'menu');
        $CI->load->model('Usuario_model', 'us');
        $roles_completo = $CI->us->get_rol_acceso($id_usuario); //Obtiene roles del usuario
        $roles = $CI->us->get_limpia_array_rol($roles_completo); //Obtiene roles del usuario

        $menu = $CI->menu->get_modulos_acceso($roles); //Obtiene el menu 
        
        foreach ($menu as $val ){
            if($val['url'] == $url){
                return true;;
            }
        }

        return FALSE;
    }

}
