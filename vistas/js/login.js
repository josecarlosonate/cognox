$(document).ready(function() {

    $("#formLogin").validate({
        rules:{
            loginUsuario:{
                required:true,
                number:true,
                minlength: 7,
                maxlength:10
            },
            passwdCheck:{
                required:true,
                number:true,
                minlength: 4,
                maxlength:4
            }
        },
        messages: {
            loginUsuario: {
                required: "El campo identificación es obligatorio.",
                number: "Este campo identificación solo puede contener numeros",
                minlength: "Debe tener al menos 7 caracteres",
                maxlength: "Debe tener maximo 10 caracteres"
            },
            passwdCheck: {
                required: "El campo contraseña es obligatorio.",
                number: "Este campo contraseña solo puede contener numeros",
                minlength: "Debe tener al menos 4 caracteres",
                maxlength: "Debe tener maximo 4 caracteres"
            }
        }
    });
});

//click en inicio de sesion
$("#btn-acceder").click(function() {
    if ($("#formLogin").valid() === false) {
        return;
    }

    let usuario = $('#loginUsuario').val();
    let pass = $('#passwdCheck').val();

    // objeto de datos
    let objDatos = {
        user: usuario,
        pass: pass
    };

    let accion = "inicio";

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
            $("#btn-acceder").val("Espere por favor...");
            $("#btn-acceder").prop("disabled", true);
        },
        success: function(response) {    
            console.log(response);        
            let res = JSON.parse(response);
            if(res.code == '002'){ /* identificacion erronea */
                $('#loginUsuario').css("border-color", "red");
                $('#loginUsuario').css("box-shadow", "0 0 0 0.2rem rgb(255 0 62 / 25%)");
                $('#loginUsuario').focus();
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: res.msn
                });                
            }
            if(res.code == '003'){ /* contraseña erronea */
                $('#passwdCheck').css("border-color", "red");
                $('#passwdCheck').css("box-shadow", "0 0 0 0.2rem rgb(255 0 62 / 25%)");
                $('#passwdCheck').focus();
                $('#loginUsuario').css("border-color", "#dfdfdf");
                $('#loginUsuario').css("box-shadow","0 0 0.2rem rgb(0 123 255 / 25%)");
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: res.msn
                });                
            }
            if(res.code == '200'){ /* todo salio bien redirreciono al menu*/
                $('#passwdCheck').css("border-color", "#dfdfdf");
                $('#passwdCheck').css("box-shadow","0 0 0.2rem rgb(0 123 255 / 25%)");
                $('#loginUsuario').css("border-color", "#dfdfdf");
                $('#loginUsuario').css("box-shadow","0 0 0.2rem rgb(0 123 255 / 25%)");
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: res.msn,
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    window.location = "menu.php";
                });             
            }
            $("#btn-acceder").prop("disabled", false);
            $("#btn-acceder").val("Acceder");
            
        }
    });
}