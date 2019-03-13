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
 * @author leas
 */
class Loader {

    private static $libre_acceso = array(
        'inicio/index', 'inicio/captcha', 'inicio/cerrar_sesion', 'ayuda/get'
    );

    function load() {
        $this->acceso();
//        pr('$usuario aquí 1');
    }

    private function acceso() {
        $CI = & get_instance(); //Obtiene la insatancia del super objeto en codeigniter para su uso directo
        $controlador = $CI->uri->rsegment(1);  //Controlador actual o dirección actual
        $accion = $CI->uri->rsegment(2);  //Función que se llama en el controlador

        $url = $controlador . '/' . $accion;

        if (!in_array($url, Loader::$libre_acceso)) { //cambiar para localizar modulos de libre acceso como login
            $administra_sistema = $CI->session->userdata(EnGen::KEYSESION_DATA);

            if (!is_null($administra_sistema) && isset($administra_sistema[EnGen::KEYSESIONCOMF_USUARIO][EnGen::KEYSESIONDATA_ID])) {
                $usuario = $administra_sistema[EnGen::KEYSESIONCOMF_USUARIO][EnGen::KEYSESIONDATA_ID];
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
//        pr($CI);

        $modulos = $CI->niveles_acceso->getModulos(); //Obtiene el menu 

        foreach ($modulos as $val) {
            if ($val['url'] == $url) {
                return true;
            }
        }

        return FALSE;
    }

}
