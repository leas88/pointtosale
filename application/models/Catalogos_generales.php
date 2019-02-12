<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Catalogos_generales extends CI_Model {

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
    }

    /**
     * 
     * @param type $entidad Nombre de la tabla principal
     * @param type $select
      , es un array con el nombre de las columnas que mostrara la consulta
     * @param type $array_where
      , array con la siguiente estructura: nameColumn => [typeWhere, valorWhere].
     * Si el where es noramal (typo "and"), entonces, "nameColumn" contentra el valor solicitado (no array ni objeto)
     * posible valor de typeWhere: "or_where_in, where_not_in, where, 
     * @param type $join
      , array con la siguiente estructura: nameColumn => [typeJoin , condicionesJoin].
     * Si el join es noramal (typo "inner"), entonces, "nameColumn" contentra la condici{on de join     
     * Posible type de join "right and left"
     * @param type $order_by orden[]
     * @param type $group_by agrupamiento[]
     * @param type $distinct bool, true para que muetre un distinct
     * @return type
     */
    public function getConsutasGenerales($entidad, $select = '*', $array_where = null, $join = null, $order_by = null, $group_by = null, $distinct = false) {
//        pr($entidad . ' => ' . $type_where);
        if (!is_null($array_where)) {
            foreach ($array_where as $key => $value) {
                if (is_array($value)) {
                    $typeWhere = $value['typeWhere'];
                    $this->db->{$typeWhere}($key, $value);
                } else {
                    $this->db->where($key, $value);
                }
            }
        }

        if ($distinct) {
            $this->db->distint();
        }

        $this->db->select($select); //Asigna el select de la consulta 

        if (!is_null($order_by)) {
            if (is_array($order_by)) {
                foreach ($order_by as $column => $ascdesc) {
                    $this->db->order_by($column, $ascdesc);
                }
            } else {
                $this->db->order_by($order_by);
            }
        }
        if (!is_null($group_by)) {
            $this->db->group_by($group_by);
        }
        if (!is_null($order_by)) {
            if (is_array($order_by)) {
                foreach ($order_by as $column => $ascdesc) {
                    $this->db->order_by($column, $ascdesc);
                }
            } else {
                $this->db->order_by($order_by);
            }
        }
        $query = $this->db->get($entidad);
        $resultArray = $query->result_array();
        $query->free_result();
//        pr($this->db->last_query());
        return $resultArray;
    }

    public function delete_registro_general($entidad, $array_where) {
        $this->db->trans_begin();
        if (!is_null($array_where)) {
            foreach ($array_where as $key => $value) {
                if (is_array($value)) {
                    $typeWhere = $value['typeWhere'];
                    $this->db->{$typeWhere}($key, $value);
                } else {
                    $this->db->where($key, $value);
                }
            }
            $this->db->delete($entidad);
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return -1;
            } else {
                $this->db->trans_commit();
                return 1;
            }
        }
    }

    public function insert_registro_general($entidad, $datos) {
        $this->db->trans_begin();
        $this->db->insert($entidad, $datos);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return -1;
        } else {
            $this->db->trans_commit();
            return 1;
        }
    }

    public function update_registro_general($entidad, $data, $array_where) {
        $this->db->trans_begin();
        foreach ($array_where as $key => $value) {
            if (is_array($value)) {
                $typeWhere = $value['typeWhere'];
                $this->db->{$typeWhere}($key, $value);
            } else {
                $this->db->where($key, $value);
            }
        }
        $this->db->update($entidad, $data);
//        pr($this->db->last_query());
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return -1;
        } else {
            $this->db->trans_commit();
            return 1;
        }
    }

}
