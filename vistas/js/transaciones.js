$(document).ready(function() {
    //metodo alfanumerico
    $.validator.addMethod("alfanum", function(value, element) {
        let expresion = /^[a-zA-Z0-9- ]*$/;
        return expresion.test(value);
    });

    //validar formulario de registro de transacion propia
    $("#formPropias").validate({
        rules:{
            corigen:{
                required:true,
                alfanum:true
            },
            cdestino:{
                required:true,
                alfanum:true
            },
            monto:{
                required:true,
                number:true,
                minlength: 4
            }
        },
        messages: {
            corigen:{
                required: "Seleccione cuenta de origen.",
                alfanum: 'No se aceptan caracteres especiales.'
            },
            cdestino:{
                required:"Seleccione cuenta de destino.",
                alfanum: 'No se aceptan caracteres especiales.'
            },
            monto:{
                required:"El campo Monto es obligatorio.",
                number: "Este campo Monto solo puede contener numeros",
                minlength: "Debe tener al menos 4 caracteres",
            }
            
        }
    });
} );


//click en trasferir
$("#btn-trasferir").click(function() {
    if ($("#formPropias").valid() === false) {
        return;
    }

    let corigen = $('#corigen').val();
    let cdestino = $('#cdestino').val();
    let monto = $('#monto').val();
    let idUser = $('#idUser').val();

    // objeto de datos
    let objDatos = {
        corigen: corigen,
        cdestino: cdestino,
        monto: monto,
        idUser: idUser
    };

    let accion = "transferirPropia";

    enviarAjax(JSON.stringify(objDatos), accion);

});

function enviarAjax(datos, accion) {
    $.ajax({
        async: true,
        url: "../ajax/ajax.php",
        type: "POST",
        data: {
            accion: accion,
            data: datos,
        },
        beforeSend: function() {
            $("#btn-trasferir").val("Espere por favor...");
            $("#btn-trasferir").prop("disabled", true);
        },
        success: function(response) {    
            console.log(response);   
            let res = JSON.parse(response);
            console.log(res);
            if(res.code == '002'){ /* dato erroneo erronea */
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: res.msn
                });                
            }
            if(res.code == '200'){ /* todo salio bien actualizo listado*/
                /* limpiar form */
                $('#corigen').val('');
                $('#cdestino').val('');
                $('#monto').val('');
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: res.msn
                }); 
            }
            $("#btn-trasferir").prop("disabled", false);
            $("#btn-trasferir").val("Transferir");
            
        }
    });
}