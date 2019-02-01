<?php

class MY_Form_validation extends CI_Form_validation
{

    function __construct($config = array())
    {
        parent::__construct($config);
        /*
          $this->CI =& get_instance();
          $this->CI->load->helper('captcha');
          $this->CI->load->library('session'); */
    }

    public function alpha_accent_space($str)
    {
        $exp = '/^[\p{L}- ]*$/u';
        return (!preg_match($exp, $str)) ? FALSE : TRUE;
    }

    public function alpha_numeric_accent_space($str)
    {
        $exp = '/^[\p{L}-0123456789 ]*$/u';
        return (!preg_match($exp, $str)) ? FALSE : TRUE;
    }

    public function alpha_numeric_accent_space_dot($str)
    {
        $exp = '/^[\p{L}-0123456789,. \s]*$/u';
        return (!preg_match($exp, $str)) ? FALSE : TRUE;
    }

    /**/

    public function alpha_accent_space_dot_quot($str)
    {
        $exp = '/^[\p{L}-,.\s]*$/u';
        return (!preg_match($exp, $str)) ? FALSE : TRUE;
    }

    public function alpha_numeric_accent_slash($str)
    {
        $exp = '/^[\p{L}-0123456789.\/]*$/u';
        return (!preg_match($exp, $str)) ? FALSE : TRUE;
    }

    public function alpha_numeric_accent_space_dot_parent($str)
    {
        $exp = '/^[\p{L}-0123456789,.:\(\)\/\s]*$/u';
        return (!preg_match($exp, $str)) ? FALSE : TRUE;
    }

    public function alpha_numeric_accent_space_dot_double_quot($str)
    {
        $exp = '/^[\p{L}-0123456789,.:\(\)\/\s]*$/u';
        //$exp = '/^[\p{L}-0123456789,.:;\'\"\(\)\/\s]*$/u';
        return (!preg_match($exp, $str)) ? FALSE : TRUE;
    }

    public function exists_a_number($str)
    {
        $exp = '/^[0123456789,]+*$/u';
        //$exp = '/^[\p{L}-0123456789,.:;\'\"\(\)\/\s]*$/u';
        return (!preg_match($exp, $str)) ? FALSE : TRUE;
    }

    public function exists_a_uppercase($str)
    {
        $exp = '/^[A-Z,]*$/u';
        //$exp = '/^[\p{L}-0123456789,.:;\'\"\(\)\/\s]*$/u';
        return (!preg_match($exp, $str)) ? FALSE : TRUE;
    }

    public function exists_a_lowercase($str)
    {
        $exp = '/^[a-z,]*$/u';
        return (!preg_match($exp, $str)) ? FALSE : TRUE;
    }

    public function exists_a_aspecial_character($str)
    {
        $exp = '/^[%$#,]*$/u';
        return (!preg_match($exp, $str)) ? FALSE : TRUE;
    }

    public function exists_a_aspecial_character_password($str)
    {
        $exp = '/^[*\/_+-,]*$/u';
        return (!preg_match($exp, $str)) ? FALSE : TRUE;
    }

    /**
     * Valida que la hora inicial sea menor a la final
     */
    public function validar_hora_inicial($str)
    {
//        pr($str);
        if (isset($_POST['hora_inicial']) AND isset($_POST['hora_final']))
        {
            return $_POST['hora_inicial'] < $_POST['hora_final'];
        }
        return FALSE;
    }

    public function validar_hora_final($str)
    {
//        pr($str);
        if (isset($_POST['hora_inicial']) AND isset($_POST['hora_final']))
        {
            return $_POST['hora_inicial'] < $_POST['hora_final'];
        }
        return FALSE;
    }

    /*
     * validación contraseña
     */

    public function valid_pass_user($str)
    {
        $exp = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])([A-Za-z\d$@$!%*?&]|[^ ]){8,15}$/";
        return (!preg_match($exp, $str)) ? FALSE : TRUE;
    }

    /*
      falta validacion pa ra % $ # & !
     */

    // /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])([A-Za-z\d$@$!%*?&]|[^ ]){8,15}$/
    public function validate_url($url)
    {
        $url = trim($url);
        $url = stripslashes($url);
        $url = htmlspecialchars($url);

        // check address syntax is valid or not(this regular expression also allows dashes in the URL)
        if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $url))
        {
            return FALSE;
        } else
        {
            return TRUE;
        }
    }

    /* Formato yyyy-mm-dd */

    public function validate_date($date)
    {
        $exp = '/^\d{4}[\/\-](0?[1-9]|1[012])[\/\-](0?[1-9]|[12][0-9]|3[01])$/';
        return (!preg_match($exp, $date)) ? FALSE : TRUE;
    }

    public function validate_date_dd_mm_yyyy($date)
    {
        $exp = '/^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$/';
        return (!preg_match($exp, $date)) ? FALSE : TRUE;
    }

    /* public function compare_date($end, $start){
      if($start>$end){
      return false;
      } else {
      return true;
      }
      } */

    public function radio_buttom_validation($str)
    {
//        $exp = '/^[0-9]+$/';
//        return (!preg_match($exp, $value)) ? FALSE : TRUE;
        return is_array($str) ? (bool) count($str) : (trim($str) !== '');
    }

    public function check_captcha($str)
    {
        $this->CI = & get_instance();
        $this->CI->load->library('session');

        $this->CI->load->config('general');
        $status_servidor = $this->CI->lang->line('status_sistema');
        if ($status_servidor != null && $status_servidor == 'T')
        {
            return true;
        }

        $word = $this->CI->session->userdata('captchaWord');
        if (strcmp(strtoupper($str), strtoupper($word)) == 0)
        {
            return true;
        } else
        {
            //$this->form_validation->set_message('check_captcha','Por favor introduce correctamente los caracteres');
            return false;
        }
    }

    /**
     * @author LEAS
     * @fecha creación 03/abril/2016
     * @param String $str
     * @return true si el correo es valido 
     * 
     */
    public function valida_correo_electronico($str)
    {
        $exp = '/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(\.[a-z]{2,4})$/';
        return (!preg_match($exp, $str)) ? FALSE : TRUE;
    }

    public function matches($str, $field)
    {
        if (!isset($_POST[$field]))
        {
            return FALSE;
        }
        $field = $_POST[$field];
        return ($str !== $field) ? FALSE : TRUE;
    }

    /**
     * 
     * @author LEAS
     * @param type $folio folio del comprobante
     * @return type tru
     */
    public function is_folio_comprobante_unico($folio)
    {
        $this->CI = & get_instance();
        $this->CI->load->model('Formulario_model', 'fm');
        return !$this->CI->fm->get_valida_folio($folio);
    }

    public function valida_date_duracion_fecha_inicial($str)
    {
//        pr($str);
        if (isset($_POST['fecha_inicial']) AND isset($_POST['fecha_final']))
        {
            return valida_fecha_inicial_menor_final($_POST['fecha_inicial'], $_POST['fecha_final']);
        }
        return FALSE;
    }

    public function valida_date_duracion_fecha_final($str)
    {
//        pr($str);
        if (isset($_POST['fecha_inicial']) AND isset($_POST['fecha_final']))
        {
            return valida_fecha_inicial_menor_final($_POST['fecha_inicial'], $_POST['fecha_final']);
        }
        return FALSE;
    }

    public function valida_date_certificado_concejo_fecha_inicial($str)
    {
//        pr($str);
//        pr('algo imprime....');

        if (isset($_POST['cert_vigencia_inicial']) AND isset($_POST['cert_vigencia_termino']))
        {
            return valida_fecha_inicial_menor_final($_POST['cert_vigencia_inicial'], $_POST['cert_vigencia_termino']);
        }
        return FALSE;
    }

    public function valida_date_certificado_concejo_fecha_final($str)
    {
//        pr('ahsjhajhs');
//        return TRUE;
        if (isset($_POST['cert_vigencia_inicial']) AND isset($_POST['cert_vigencia_termino']))
        {
            return valida_fecha_inicial_menor_final($_POST['cert_vigencia_inicial'], $_POST['cert_vigencia_termino']);
        }
        return FALSE;
    }

    public function valida_requerido()
    {

        $formacion = $_POST['"formacion_prof_prof"'];
        if ($formacion == 14)
        {
            
        }

        if ($date1 > $date2)
        {
            return false;
        }

        return true;
    }

    /**
     * 
     * @param type $str
     * @param type $parametros
     * @return type
     * Valida que la fecha de inicio sea menor que la fecha de termino
     */
    public function valida_fecha_inicio_menor_fecha_fin($str, $parametros)
    {
        $respuesta = FALSE;
        if (!empty($str) AND ! empty($parametros))
        {//Valida que lleguen parametros a validar
            $post_param = explode('~', $parametros);
            $CI = & get_instance();
            if (isset($post_param[0]) AND ! empty($post_param[0]))
            {//Valida que haya solamente dos parametros de fecha
                if (!is_null($CI->input->post($post_param[0])) || !empty($CI->input->post($post_param[0])))
                {//Valida que existan los parametros en post
//                    pr($CI->input->post($post_param[0]));
                    $respuesta = valida_fecha_inicial_menor_final($str, $CI->input->post($post_param[0]));
                }
            }
            if (isset($post_param[1]) AND ! empty($post_param[1]))
            {//Valida que exista un mensaje particular
                //Modifica mensaje de fecha
                $CI->form_validation->set_message('valida_fecha_inicio_menor_fecha_fin', $post_param[1]);
            }
        }

        return $respuesta;
    }

    /**
     * 
     * @param type $str
     * @param type $parametros
     * @return type
     * Valida que la fecha de termino sea mayor que la fecha de inicio
     */
    public function valida_fecha_fin_mayor_inicio($str, $parametros)
    {
        $respuesta = FALSE;
        if (!empty($str) AND ! empty($parametros))
        {//Valida que lleguen parametros a validar
            $post_param = explode('~', $parametros);
            $CI = & get_instance();
            if (isset($post_param[0]) AND ! empty($post_param[0]))
            {//Valida que haya solamente dos parametros de fecha
                if (!is_null($CI->input->post($post_param[0])) || !empty($CI->input->post($post_param[0])))
                {//Valida que existan los parametros en post
                    $respuesta = valida_fecha_inicial_menor_final($CI->input->post($post_param[0]), $str);
                }
            }
            if (isset($post_param[1]) AND ! empty($post_param[1]))
            {//Valida que exista un mensaje particular
                //Modifica mensaje de fecha
                $CI->form_validation->set_message('valida_fecha_fin_mayor_inicio', $post_param[1]);
            }
        }

        return $respuesta;
    }

    public function obliga_actualiza_certificado($str, $field)
    {
        if (!empty($_POST['censo_regstro']) and isset($_POST[$field]) and ! empty($_POST[$field]))
        {
//        if (isset($_POST[$field]) and ! empty($_POST[$field])) {
//            $is_mayor_actual = valida_fecha_mayor_actual($_POST[$field]);
            return valida_fecha_mayor_actual($_POST[$field]);
        }
        return true;
    }

    /**
     * @author LEAS88
     * @param type $str
     * @return boolean retorna true si la regla de tipo de curso para la cantidad 
     * de titulares es menor o igual que el registro a ingresar; false si no cumple con 
     * la regla de tipo de curso
     */
    public function regla_titulares($str)
    {
        $field = 'num_profesores_titulares';
        if (isset($this->validation_data['implementacion']) && isset($this->validation_data[$field]) and ! empty($this->validation_data[$field]))
        {
            return valida_regla_profesores($field, $this->validation_data[$field], $this->validation_data['implementacion']);
        }
        return true;
    }

    /**
     * @author LEAS88
     * @param type $str
     * @return boolean retorna true si la regla de tipo de curso para la cantidad 
     * de adjuntos es menor o igual que el registro a ingresar; false si no cumple con 
     * la regla de tipo de curso
     */
    public function regla_adjuntos($str)
    {
        $field = 'num_profesores_adjuntos';
        if (isset($this->validation_data['implementacion']) && isset($this->validation_data[$field]) and ! empty($this->validation_data[$field]))
        {
            return valida_regla_profesores($field, $this->validation_data[$field], $this->validation_data['implementacion']);
        }
        return true;
    }

    /**
     * @author LEAS88
     * @param type $str
     * @return boolean true si pasa la validación y el profesor adjunto no se encuentra registrado en el mismo curso
     */
    public function valida_profesores_diferentes($str)
    {
        $field = 'num_profesores_adjuntos';
        if (isset($this->validation_data['profesores']) && isset($this->validation_data[$field]) and ! empty($this->validation_data[$field]))
        {
            $CI = & get_instance();
            $CI->load->model('Profesores_model', 'p');
            $participantes = genera_array_explode_numerico($str, ','); //Separa registros en arras
            $detalle_participante = $CI->p->get_profesores_registrados($participantes, null, "where_in", TRUE);
//            pr($detalle_participante);
            return $detalle_participante == count($participantes);
        }
        return true;
    }

    /**
     * @author LEAS
     * @fecha 8/3/2018
     * @param type $str id de la regla del tipo de curso
     * @return boolean true si es valida
     * @description Si la regla que se pretende cambiar es valida con la 
     * cantidad de profesores asignados a la implementación
     */
    public function valida_aplica_regla_tipo_curso($str)
    {
        $field = 'implementacion';
        $CI = & get_instance();
        $CI->load->model('Implementaciones_model', 'imp');

        if (isset($this->validation_data[$field]) and ! empty($this->validation_data[$field]))
        {
            $datos = $CI->imp->get_total_profesores_asignados_implementacion_por_rol($this->validation_data[$field], $str);
            $valido = true;
            if (!empty($datos))
            {
                foreach ($datos as $value)
                {
//                    pr($value);
                    if ($value['total_registros'] > $value['total_por_regla'])//Si el total de registros es mayor que el número máximo de la regla, no debera poder cambiar la regla
                    {
                        $valido = FALSE;
                        break;
                    }
                }
            }
            return $valido;
        }
        return true;
    }

    /**
     * @author LEAS
     * @fecha 21/3/2018
     * @param type $str id de la regla del tipo de curso
     * @return boolean true si es valida
     * @description Si la regla que se pretende cambiar es valida con la 
     * cantidad de máxima alumnos asignados a la implementación
     */
    public function valida_aplica_regla_tipo_curso_alumnos($str)
    {
        $field = 'implementacion';
        $CI = & get_instance();
        $CI->load->model('Implementaciones_model', 'imp');

        if (isset($this->validation_data[$field]) and ! empty($this->validation_data[$field]))
        {
            $datos = $CI->imp->get_total_profesores_asignados_implementacion_por_rol($this->validation_data[$field], $str, [3]); //Consulta únicamente participantes alumnos
            $valido = true;
            if (!empty($datos))
            {
                if ($datos[0]['total_registros'] > $datos[0]['total_por_regla_alumnos'])//Si el total de registros es mayor que el número máximo de la regla, no debera poder cambiar la regla
                {
                    $valido = FALSE;
                }
            }
            return $valido;
        }
        return true;
    }

    /**
     * @author LEAS
     * @fecha 21/3/2018
     * @param type $str id de la regla del tipo de curso
     * @return boolean true si es valida
     * @description Si la regla que se pretende cambiar es valida con la 
     * cantidad de máxima alumnos asignados a la implementación
     */
    public function valida_clave_implementacion_unica($str, $field)
    {
        $CI = & get_instance();
        $CI->load->model('Implementaciones_model', 'imp');
        $datos = $CI->imp->get_existe_implementacion($this->validation_data[$field], $str); //Consulta únicamente participantes alumnos
        return (empty($datos));
    }

    /**
     * @author LEAS88
     * @param type $str
     * @return boolean Valida que aún existe cupo para guardar alumnos, 
     * si la regla de tipo de curso "cantidad maxima de alumnos cumple" retorna true; de no ser así, retorna false
     */
    public function valida_cantidad_alumnos_implementacion_completa($str)
    {
        $CI = & get_instance();
        $CI->load->model('Implementaciones_model', 'imp');
        $result = $CI->imp->get_total_profesores_asignados_implementacion_por_rol($str, null, [3]);
        if (!empty($result))
        {
            if ($result[0]['total_registros'] > $result[0]['total_por_regla_alumnos'])
            {
                return FALSE;
            }
            return true;
        }
        return TRUE;
    }

    /**
     * @author LEAS88
     * @param type $str
     * @param type $field es el nombre o campo implementacion id, es la que valida que el participante no exista actualmente
     * @return boolean Valida que el participante no se encuentre actualmente 
     * registrado en el sistema en la implementación mensionada. Regresa "true" si no se encuetra registrado actualmente
     */
    public function valida_participante_unico($str, $field)
    {
//        $result = $this->imp->get_total_profesores_asignados_implementacion_por_rol($str, null, [3]);
        if (isset($this->validation_data[$field]) && !empty($this->validation_data[$field]))
        {
            $CI = & get_instance();
            $CI->load->model('Implementaciones_model', 'imp');
            $result_data = $CI->imp->get_participantes_in_implementaciones($this->validation_data[$field], $str);
//            pr($detalle_participante);
            return empty($result_data);
        }
        return true;
    }

    /**
     * @author LEAS88 
     * @param type $str
     * @param type $field
     */
    public function valida_folio_certificado_implementacion($str, $field)
    {
//        pr($this->validation_data);
        if (isset($this->validation_data[$field]) && !empty($this->validation_data[$field]))
        {
            $CI = & get_instance();
            $CI->load->model('Constancias_model', 'constancias');
            
            $result_data = $CI->constancias->valida_folio_implementacion($this->validation_data[$field], $this->validation_data['implementacion'], $str);
//            pr($detalle_participante);
            return empty($result_data);
        }
        return FALSE;
    }

    public function not_space($str)
    {
        $exp = '/\s/';
        return (!preg_match($exp, $str)) ? TRUE : FALSE;
    }

    /**
     * @author LEAS
     * @fecha 10/08/2017
     * @param type $str Valor del campo
     * @return type true si la fecha ingresada es menor a la fecha maxíma indicada 
     * en las reglas de validación, se asocia a que los ciclos clínicos no existen 
     * despues del 2018, por tal razón no puede ser mayor 
     */
    public function ciclos_clinicos_fecha_maxima($str, $fecha_maxima)
    {
//        $result = valida_fecha_inicial_menor_final($str, '01/01/2018');
        $result = valida_fecha_inicial_menor_final($str, $fecha_maxima);
        return $result;
    }

    /**
     * @author LEAS
     * @fecha 10/08/2017
     * @param type $str Valor del campo
     * @return type Compara que el valor del campo a fin de tipo fecha sea menor a la 
     * fecha indicada, ejemplo uso:  fecha_maxima_indicada[01/01/2018]
     */
    public function fecha_maxima_indicada($str, $fecha_maxima)
    {
//        $result = valida_fecha_inicial_menor_final($str, '01/01/2018');
        $result = valida_fecha_inicial_menor_final($str, $fecha_maxima);
        return $result;
    }

}
