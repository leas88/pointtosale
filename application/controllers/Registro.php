<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Registro extends MY_Controller {

    const LISTA = 'listar', EDITAR = 'editar', INSERTAR = 'insertar', ELIMINAR = 'eliminar';

    function __construct() {
        parent::__construct();
        $this->load->library('form_complete');
        $this->load->library('form_validation');
        $this->load->model('Registro_clientes_model', 'reg_cli');
    }

    public function index() {
        
    }

    public function inicio() {
        $this->template->setTitle('Inicio');
        $main_content = $this->load->view('ingenia/clientes.tpl.php', [], true);
        $this->template->setMainContent($main_content);
        $this->template->getTemplate();
    }

    public function clientes($tipo) {
        
        switch ($tipo) {
            case Registro::LISTA:
                $resultado = $this->reg_cli->get_clientes();
                header('Content-Type: application/json; charset=utf-8;');
                echo json_encode($resultado);
                break;
            case Registro::EDITAR:
                $this->editar();
                break;
            case Registro::INSERTAR:
                $this->insertar();
                break;
            case Registro::ELIMINAR:
                $this->eliminar();
                break;
        }
        return;
    }

    private function editar() {
        $data["texts"] = $this->lang->line('interface')['general_model'];
        if ($this->input->post()) {
            $post = $this->input->post(null, true);
//            pr($post);
            $this->config->load('form_validation'); //Cargar archivo con validaciones
            $validations = $this->config->item('form_actualizar'); //Obtener validaciones de archivo general
            $this->form_validation->set_rules($validations);
            $result = ['success' => FALSE, 'data' => [], 'message' => ''];
            if ($this->form_validation->run() == TRUE) {
                $result = $this->reg_cli->update_clientes($post, $data['texts']);
            } else {
                $errores = $this->form_validation->error_array();
//                pr($errores);
                foreach ($errores as $key => $value) {
                    $result['message'] .= $value . "\n";
                }
            }
            header('Content-Type: application/json; charset=utf-8;');
            echo json_encode($result);
        }
    }
    
    private function insertar() {
        $data["texts"] = $this->lang->line('interface')['general_model'];
        if ($this->input->post()) {
            $post = $this->input->post(null, true);
//            pr($post);
            $this->config->load('form_validation'); //Cargar archivo con validaciones
            $validations = $this->config->item('form_actualizar'); //Obtener validaciones de archivo general
            $this->form_validation->set_rules($validations);
            $result = ['success' => FALSE, 'data' => [], 'message' => ''];
            if ($this->form_validation->run() == TRUE) {
                $result = $this->reg_cli->insertar_clientes($post, $data['texts']);
            } else {
                $errores = $this->form_validation->error_array();
//                pr($errores);
                foreach ($errores as $key => $value) {
                    $result['message'] .= $value . "\n";
                }
            }
            header('Content-Type: application/json; charset=utf-8;');
            echo json_encode($result);
        }
    }
    
    private function eliminar() {
        $data["texts"] = $this->lang->line('interface')['general_model'];
        if ($this->input->post()) {
            $post = $this->input->post(null, true);
//            pr($post);
            $this->config->load('form_validation'); //Cargar archivo con validaciones
            $validations = $this->config->item('form_eliminar'); //Obtener validaciones de archivo general
            $this->form_validation->set_rules($validations);
            $result = ['success' => FALSE, 'data' => [], 'message' => ''];
            if ($this->form_validation->run() == TRUE) {
                $result = $this->reg_cli->eliminar_clientes($post, $data['texts']);
            } else {
                $errores = $this->form_validation->error_array();
//                pr($errores);
                foreach ($errores as $key => $value) {
                    $result['message'] .= $value . "\n";
                }
            }
            header('Content-Type: application/json; charset=utf-8;');
            echo json_encode($result);
        }
    }


}
