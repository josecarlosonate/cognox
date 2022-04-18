$(document).ready(function() {
    //metodo alfanumerico
    $.validator.addMethod("alfanum", function(value, element) {
        let expresion = /^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]*$/;
        return expresion.test(value);
    });

    $('#lstCuentas').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        },
        "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
    });

    //validar formulario de registro de cuenta
    $("#formCuenta").validate({
        rules:{
            numeroCuenta:{
                required:true,
                alfanum:true
            },
            monto:{
                required:true,
                number:true,
                minlength: 4
            },
            estado:{
                required:true
            }
        },
        messages: {
            numeroCuenta:{
                required: "El campo Numero de cuenta es obligatorio.",
                alfanum: 'No se aceptan caracteres especiales.'
            },
            monto:{
                required:"El campo Monto es obligatorio.",
                number: "Este campo Monto solo puede contener numeros",
                minlength: "Debe tener al menos 4 caracteres",
            },
            estado:{
                required:"El campo Estado es obligatorio."
            }
        }
    });

} );

// traer listado de cuentas
function mostrarCuentas() {
    $('#listadoCuentas').empty();
}

//click en crear cuenta
$("#btn-cuenta").click(function() {
    if ($("#formCuenta").valid() === false) {
        return;
    }

    let numeroCuenta = $('#numeroCuenta').val();
    let monto = $('#monto').val();
    let estado = $('#estado').val();
    let idUser = $('#idUser').val();

    // objeto de datos
    let objDatos = {
        numeroCuenta: numeroCuenta,
        monto: monto,
        estado: estado,
        idUser: idUser
    };

    let accion = "nuevaCuenta";

    enviarAjax(JSON.stringify(objDatos), accion);
})

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
            $("#btn-cuenta").val("Espere por favor...");
            $("#btn-cuenta").prop("disabled", true);
        },
        success: function(response) {    
            console.log(response);        
            let res = JSON.parse(response);
            if(res.code == '002'){ /* dato erroneo erronea */
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: res.msn
                });                
            }
            if(res.code == '200'){ /* todo salio bien actualizo listado*/
                /* limpiar form */
                $('#numeroCuenta').val('');
                $('#monto').val('');
                $('#estado').val('');
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: res.msn
                })            
            }
            $("#btn-cuenta").prop("disabled", false);
            $("#btn-cuenta").val("Registar Cuenta");
            
        }
    });
}