jQuery(document).on('submit','#formlg',function(event){
    event.preventDefault();

    jQuery.ajax({
        url: 'main_app/login.php',
        type: 'POST',
        dataType: 'json',
        data: $(this).serialize(),

        beforeSend: function(){
            $('.botonlg').val('validando...');
        }
    })
    .done(function(respuesta){
        console.log(respuesta);
        if(!respuesta.error){

            if (respuesta.tipo == '1'){
                location.href = 'main_app/Administrador/indexa.php';
            }else if (respuesta.tipo == '2'){
                location.href = 'main_app/Operador/indexo.php';
            }else if (respuesta.tipo == '3'){
                location.href = 'main_app/Estandar/indexe.php';
            }
        }else{
            $('error').slideDown('slow');
            setTimeout(function(){
                $('.error').slideDown('slow');
            },3000);
            $('.botonlg').val('Iniciar Sesion');
        }
    })
    .fail(function(resp){
        console.log(resp.responseText);
    })
    .always(function(){
        console.log("complete");
    });
});