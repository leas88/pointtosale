
$(function(){
    $('#boton_registro').click(function(event){
        var destino = site_url + '/welcomee/registro';
        data_ajax(destino, null, '#registro_modal_content');
    });       
})