<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

$config["login"] = array(
    array(
        'field' => 'usuario',
        'label' => 'Usuario',
        'rules' => 'required',
        'errors' => array(
            'required' => 'El campo %s es obligatorio, favor de ingresarlo.',
        ),
    ),
    array(
        'field' => 'password',
        'label' => 'Contraseña',
        'rules' => 'required',
        'errors' => array(
            'required' => 'El campo %s es obligatorio, favor de ingresarlo.',
        ),
    ),
    array(
        'field' => 'captcha',
        'label' => 'Imagen de seguridad',
        'rules' => 'required|check_captcha',
        'errors' => array(
            'required' => 'El campo %s es obligatorio, favor de ingresarlo.',
            'check_captcha' => "El texto no coincide con la imagen, favor de verificarlo."
        ),
    ),
);


$config['form_actualizar'] = array(
    array(
        'field' => 'name',
        'label' => 'Nombre',
        'rules' => 'trim|required|max_length[100]' 
    ),
    array(
        'field' => 'firstname',
        'label' => 'Apellido paterno',
        'rules' => 'trim|required|max_length[100]' 
    ),
    array(
        'field' => 'lastname',
        'label' => 'Apellido materno',
        'rules' => 'trim|required|max_length[100]' 
    ),
    array(
        'field' => 'phone',
        'label' => 'Teléfono',
        'rules' => 'trim|required|is_numeric|max_length[10]' 
    ),
    array(
        'field' => 'credit_card',
        'label' => 'Número de tarjeta de credito',
//        'rules' => 'trim|required|is_numeric|exact_length[16]' 
        'rules' => 'trim|required|is_numeric' 
    ),
    array(
        'field' => 'email',
        'label' => 'Correo electrónico',
        'rules' => 'trim|required|valida_correo_electronico' 
    ),
);

$config['form_eliminar'] = array(
    array(
        'field' => 'id_customer',
        'label' => 'Cliente',
        'rules' => 'trim|required' 
    ),
);

// VALIDACIONES
/*
             * isset
             * valid_email
             * valid_url
             * min_length
             * max_length
             * exact_length
             * alpha
             * alpha_numeric
             * alpha_numeric_spaces
             * alpha_dash
             * numeric
             * is_numeric
             * integer
             * regex_match
             * matches
             * differs
             * is_unique
             * is_natural
             * is_natural_no_zero
             * decimal
             * less_than
             * less_than_equal_to
             * greater_than
             * greater_than_equal_to
             * in_list
             * validate_date_dd_mm_yyyy
             * validate_date
             * form_validation_match_date  la fecha debe ser mayor que ()
             *
             *
             *
             */


//custom validation

/*

alpha_accent_space_dot_quot
 *
alpha_numeric_accent_slash
 *
alpha_numeric_accent_space_dot_parent
 *
alpha_numeric_accent_space_dot_double_quot

*/

/*
*password_strong
*
*
*
*
*/
