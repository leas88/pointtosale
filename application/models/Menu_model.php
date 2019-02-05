<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Menu_model
 *
 * @author chrigarc
 */
class Menu_model extends CI_Model {

    //put your code here
    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_modulos_acceso($id_usuario) {
        if (empty($id_usuario)) {
            return [];
        }
        $this->db->flush_cache();
        $this->db->reset_query();
        $select = array(
            "m.cve_module", "m.modulename", "m.url", "mt.name type_module",
            "m.module_pather", "m.config_json", "m.cve_modulegroup", "mg.name group_module", "mg.orden orden_grupo",
            "m.icon"
        );
        $this->db->select($select);
        $this->db->where('ur.id_user', $id_usuario);
        $this->db->where('(um.acceso or um.acceso is null)', null);
        $this->db->join('system_modulo m', '(m.cve_module = rm.cve_modulo and m.active)', 'inner');
        $this->db->join('system_module_type mt', '(mt.id_moduletype = m.id_moduletype and mt.active)', 'inner');
        $this->db->join('system_rol r', 'r.id_rol = rm.id_rol', 'inner');
        $this->db->join('system_user_rol ur', 'ur.id_rol = rm.id_rol', 'inner');
        $this->db->join('system_user_modulo um', 'um.cve_modulo = rm.cve_modulo', 'left');
        $this->db->join('system_module_group mg', 'mg.cve_modulegroup = m.cve_modulegroup', 'left');
        $this->db->order_by('mg.orden');
        $this->db->order_by('m.orden');
        $this->db->order_by('m.modulename');

        $query = $this->db->get('system_rol_modulo rm');

        $modulos_acceso = $query->result_array();
        $query->free_result(); //Libera la memoria
        $this->db->flush_cache();
        $this->db->reset_query();
        return $modulos_acceso;
    }

}
