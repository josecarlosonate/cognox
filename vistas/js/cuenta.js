$(document).ready(function() {
    //metodo alfanumerico
    $.validator.addMethod("alfanum", function(value, element) {
        let expresion = /^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]*$/;
        return expresion.test(value);
    });

    $('#lstCuentasx').DataTable({
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
    let idUser = $('#idUser').val();
    $.ajax({
        async: true,
        url: "../ajax/ajax.php",
        type: "POST",
        data: {
            id: idUser,
            accion: "lstCuentas",
        },
        success: function(response) {
            console.log(response);
            let data = JSON.parse(response);
            
            let cont = 0;
            data.forEach(element => {
                cont++;
                let valor = element.valor;
                valor = new Intl.NumberFormat("de-DE", { maximumFractionDigits: 0 }).format(Number(valor));

                let estado = (element.estado == '1') ? 'Habilitada':'Desabilitada';
                let tr = document.createElement('tr');
                var boton;
                if(element.estado == '1'){
                    boton = '<button type="button" id="btnDeshabilitar" onclick="cambiarEstado('+element.id +','+element.estado+')" title="Desabilitar cuenta" class="btn btn-danger">Deshabilitar</button>';
                }else{
                    boton = '<button type="button" id="habilitar" onclick="cambiarEstado('+element.id+','+element.estado+')" class="btn btn-primary">Habilitar</button>';
                };

                tr.innerHTML = `
                <th class="text-primary">${cont}</th>
                <td class="text-primary">${element.numero}</td>
                <th class="text-primary">$ ${valor}</th>
                <th class="text-primary">${estado}</th>
                <th class="text-primary">${boton}</th>
                `;
                $('#listadoCuentas').append(tr);
            })
        }
    });
}

mostrarCuentas();

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

//habilitar o deshabilitar cuenta
function cambiarEstado(id,estado){
    if(estado == 1){
        Swal.fire({
            title: "Estas segur@?",
            text: "¡Esta accion deshabilitara esta cuenta para realizar transferencias!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "¡Sí, deshabilitar!",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                cambiarEstadoAjax(id,0);                
            }
        });
    }else{
        //habilitar
        cambiarEstadoAjax(id,1);  
    }
}

function cambiarEstadoAjax(id,estado){
    $.ajax({
        async: true,
        url: "../ajax/ajax.php",
        type: "POST",
        data: {
            accion: "estadoCuenta",
            id: id,
            estado: estado
        },
        success: function(response) {
            if (response == "ok") {
                console.log('todo bien');
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Realizado con exito',
                    showConfirmButton: false,
                    timer: 1500
                });
                mostrarCuentas();
            }
            if (response == 'error') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '¡Algo salió mal!',
                    footer: 'no se pudo realizar la operacion'
                });
            }
        }
    });
}

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
                });
                mostrarCuentas();    
            }
            $("#btn-cuenta").prop("disabled", false);
            $("#btn-cuenta").val("Registar Cuenta");
            
        }
    });
}