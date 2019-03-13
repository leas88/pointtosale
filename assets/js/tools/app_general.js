/**
 * 
 * @param {type} mensaje mensaje que se va amostrar para el usuario
 * @param {type} tipo_mensaje tipo de mensaje success, danger, info o warning
 * @param {type} timeout tiempo visible antes de que se oculte, e tiempo se asigna en milisegundos
 *  recomendado 5000 = 5 segundos
 * @returns {undefined}
 */
function get_mensaje_general(mensaje, tipo_mensaje, timeout) {
    $('#mensaje_error_div').removeClass('alert-danger').removeClass('alert-success').removeClass('alert-info').removeClass('alert-warning');
    $('#mensaje_error_div').addClass('alert-' + tipo_mensaje);
    $('#mensaje_error').html(mensaje);
    $('#div_error').show();
    setTimeout("$('#div_error').hide()", timeout);
}

