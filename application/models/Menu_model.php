<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Menu_model
 *
 * @author chrigarc
 */
class Menu_model extends CI_Model
{

    //put your code here
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_modulos_acceso($roles)
    {
        if(empty($roles)){
            return []; 
        }
        $this->db->flush_cache();
        $this->db->reset_query();
        $select = array(
            'B.cve_modulo', 'B.nombre_modulo', 'B.tipo_modulo', 'B.url'
        );
        $this->db->select($select);
        $this->db->where_in('A.id_rol', $roles);
        $this->db->where('B.activo', true);
        $this->db->join('system_modulo B', 'B.cve_modulo = A.cve_modulo', 'inner');
        
        $query = $this->db->get('system_rol_modulo A');
        if ($query)
        {
            $modulos_acceso = $query->result_array();
            $query->free_result(); //Libera la memoria
        }
        $this->db->flush_cache();
        $this->db->reset_query();
        return $modulos_acceso;
    }

}
