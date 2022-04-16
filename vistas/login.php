<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="pruena tecnica">
    <meta name="description" content="realizacion de prueba php">
    <meta name="keyword" content="prueba tecnica, php">
    <title>Login</title>
    <!--=====================================
	HOJA DE CSS 
	======================================-->
    <link rel="stylesheet" href="../vistas/css/plugins/bootstrap4.min.css">
    <link rel="stylesheet" href="../vistas/css/estilo.css">
</head>
<body>
    <div class="container">
    <div class="row">
        <div class="login text-center">
            <form name="formLogin" id="formLogin" method="POST" action="" class="form-horizontal formLogin" novalidate="novalidate">
                <fieldset>
                    <legend>Datos ingreso al sistema de <strong style="font-weight: bold;">AppBank</strong></legend>
                    <div class="form-group valid">
                        <label class="control-label" for="loginUsuario">Identificación *</label>
                        <div class="col-md-12">
                            <input type="number" min="0" class="form-control" name="loginUsuario" id="loginUsuario" value="" placeholder="identificación" data-toggle="popover" data-trigger="hover" data-content="Ingrese su numero de identificación para iniciar sesión." autocomplete="off" required>
                        </div>
                    </div>
                    <div class="form-group valid">
                        <label class="control-label" for="passwdCheck">Contraseña *</label>
                        <div class="col-md-12">
                            <input type="password" class="form-control" name="passwdCheck" id="passwdCheck" value="" placeholder="Contraseña" autocomplete="off" required>
                        </div>
                    </div>
                </fieldset>               
                <div class="botones">
                    <input id="btn-acceder" type="submit" class="btn btn-default" value="Acceder">
                </div>
            </form> 
        </div>
    
    </div>
    </div>
    <!--=====================================
	PLUGINS DE JAVASCRIPT
	======================================-->
    <script src="../vistas/js/plugins/jquery-3.5.1.slim.min.js"></script>

    <script src="../vistas/js/plugins/bootstrap4.min.js"></script>

    <script src="../vistas/js/plugins/jquery.validate.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <!--=====================================
    MI JAVASCRIPT
    ======================================-->

    <script src="../vistas/js/login.js"></script>
</body>
</html>