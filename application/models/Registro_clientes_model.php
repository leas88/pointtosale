<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Registro_clientes_model extends MY_Model {

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
    }

    public function get_clientes() {
        $this->db->flush_cache();
        $this->db->reset_query();
        $this->db->select(array('id_customer', 'name', 'firstname', 'lastname', 'phone', 'email', 'credit_card'));
        return $this->db->get('ing_customer')->result_array();
    }

    public function update_clientes($data, $texts) {
        $salida = ['success' => FALSE, 'data' => []];
        $this->db->flush_cache();
        $this->db->reset_query();
        $this->db->trans_begin();

        $datos_cliente = array(
            'name' => $data['name'],
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'credit_card' => $data['credit_card'],
        );
        $this->db->where('id_customer', $data['id_customer']);
        $this->db->update('ing_customer', $datos_cliente);

        if ($this->db->trans_status() === FALSE) {
            $salida['message'] = $texts['error'];
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            $salida['message'] = $texts['actualizacion'];
            $salida['success'] = true;
            $datos_cliente['id_customer'] = $data['id_customer'];
            $salida['data'] = $datos_cliente;
        }
        $this->db->flush_cache();
        $this->db->reset_query();
        return $salida;
    }

    /**
     * @author LEAS88
     * @param type $data
     * @param type $texts
     */
    public function insertar_clientes($data, $texts) {
        $salida = ['success' => FALSE, 'data' => []];
        $this->db->flush_cache();
        $this->db->reset_query();
        $this->db->trans_begin();

        $datos_cliente = array(
            'name' => $data['name'],
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'credit_card' => $data['credit_card'],
        );
        $this->db->insert('ing_customer', $datos_cliente);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $salida['message'] = $texts['error'];
        } else {
            $this->db->trans_commit();
            $salida['message'] = $texts['insercion'];
            $salida['success'] = true;
            $id_customer = $this->db->insert_id();
            $datos_cliente['id_customer'] = $id_customer;
            $salida['data'] = $datos_cliente;
        }
        $this->db->flush_cache();
        $this->db->reset_query();
        return $salida;
    }
    
    public function eliminar_clientes($data, $texts) {
        $salida = ['success' => FALSE, 'data' => []];
        $this->db->flush_cache();
        $this->db->reset_query();
        $this->db->trans_begin();

        $this->db->where('id_customer', $data['id_customer']);
        $this->db->delete('ing_customer');
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $salida['message'] = $texts['error'];
        } else {
            $this->db->trans_commit();
            $salida['message'] = $texts['eliminacion'];
            $salida['success'] = true;
            $salida['data'] = [];
        }
        $this->db->flush_cache();
        $this->db->reset_query();
        return $salida;
    }

    
}
