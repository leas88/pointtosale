<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sesion_model extends CI_Model {
    const SESION_VALIDA = 1, PASSWOR_INCORRECTO = 2, USER_INCORRECTO = 3;


    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
    }

    function validar_usuario($usr, $passwd) {
        $this->db->flush_cache();
        $this->db->reset_query();
        $this->db->start_cache();

        $this->db->select(array('username', 'password', 'token', ''));
        $this->db->from('system_user u');
        $this->db->where('u.username', $usr);
        $this->db->where('u.activo', true);

        $num_user = $this->db->count_all_results();
        $this->db->reset_query();
        if ($num_user == 1) {
            $usuario = $this->db->get();
            $result = $usuario->result_array();

            $this->load->library('seguridad');
            $cadena = $result[0]['token'] . $passwd . $result[0]['token'];
            
            $clave = $this->seguridad->encrypt_sha512($cadena);
            if ($clave == $result[0]['password']) {
                return Sesion_model::SESION_VALIDA; //Existe
            }
            return Sesion_model::PASSWOR_INCORRECTO; //contraseña incorrrecta
        } else {
            return Sesion_model::USER_INCORRECTO; //Usuario no existe
        }

    }

}
