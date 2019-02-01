<?php

/*
 ** Clase Inicio.
 */

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Inicio
 *
 * @author chrigarc
 */
class Inicio extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_complete');
        $this->load->library('form_validation');
        $this->load->library('seguridad');
        $this->load->helper(array('secureimage'));
        $this->load->model('Sesion_model', 'sesion');
        $this->load->model('Usuario_model', 'usuario');
    }

    public function index()
    {
//        pr($this->session->userdata('ingenia'));
        //load idioma
        $data["texts"] = $this->lang->line('formulario'); //textos del formulario
        //validamos si hay datos
        if ($this->input->post())
        {
            $post = $this->input->post(null, true);
            

            $this->config->load('form_validation'); //Cargar archivo con validaciones
            $validations = $this->config->item('login'); //Obtener validaciones de archivo general
            $this->form_validation->set_rules($validations);
        
            if ($this->form_validation->run() == TRUE)
            {
                $valido = $this->sesion->validar_usuario($post["usuario"], $post["password"]);
                $mensajes = $this->lang->line('mensajes');
                switch ($valido)
                {
                    case 1:
                        //redirect to home //load menu...etc etc
                        $params = array(
                            'where' => array('username' => $post['usuario']),
                            'select' => array(
                                'id_user','username'
                            )
                        );
                        $usuario['usuario'] = $this->usuario->get_usuarios($params)[0];

                        $this->session->set_userdata('ingenia', $usuario);
                        $this->seguridad->token();//Genera un token
//                        pr($usuario);
                        //redirect(site_url() . '/inicio/dashboard');
                        redirect(site_url() . '/inicio/inicio');
                        /*$main_content = $this->load->view('sesion/index.tpl.php', null, true);
                        $this->template->setMainContent($main_content);
                        $this->template->getTemplate();*/
                        break;
                    case 2:
                        $data['errores'] = true;
                        $this->session->set_flashdata('flash_password', $mensajes[$valido]);
                        break;
                    case 3:
                        $data['errores'] = true;
                        $this->session->set_flashdata('flash_usuario', $mensajes[$valido]);
                        break;
                    default :
                        break;
                }
            } else
            {
//                pr(validation_errors());
                $data['errores'] = validation_errors();
            }
        }

        $usuario = $this->session->userdata('ingenia');
        if (isset($usuario['usuario']['id_user']))
        {
            $this->template->setTitle('Inicio');
            $main_content = $this->load->view('sesion/index.tpl.php', $data, true);
            $this->template->setMainContent($main_content);
            $this->template->getTemplate();
        } else
        {
            //cargamos plantilla
            $data['my_modal'] = $this->load->view("sesion/login_modal.tpl.php", $data, TRUE);
            $this->load->view("sesion/login.tpl.php", $data);
        }
    }

    public function inicio(){
        $this->template->setTitle('Inicio');
        $main_content = $this->load->view('sesion/index.tpl.php', [], true);
        $this->template->setMainContent($main_content);
        $this->template->getTemplate();
    }

    function captcha()
    {
        new_captcha();
    }

    public function cerrar_sesion()
    {
        $this->session->sess_destroy();
        redirect(site_url());
    }

    
}
