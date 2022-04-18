<?php
require_once "../includes/funciones.php";
require_once "../controladores/cuentasControlador.php";
session_start();
isAuth();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="pruena tecnica">
    <meta name="description" content="realizacion de prueba php">
    <meta name="keyword" content="prueba tecnica, php">
    <title>Cuentas Propias</title>
    <!--=====================================
	HOJA DE CSS 
	======================================-->
    <link rel="stylesheet" href="../vistas/css/plugins/bootstrap4.min.css">
    <link rel="stylesheet" href="../vistas/css/estilo.css">
</head>

<body>
    <nav class="navbar menu" aria-label="">
        <a id="navMenu" class="navbar-brand" href="/">
            AppBank
        </a>
        <div class="float-right pr-5">
            <p class="text-white"><?php echo $_SESSION['nombre'].' '.$_SESSION['apellido_paterno'] ?></p>            
        </div>
    </nav>
    <div id="wave" style="height: 150px; overflow: hidden;">
        <svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 100%; width: 100%;">
            <path d="M-11.00,76.48 C157.73,123.86 306.15,29.13 501.97,58.72 L500.00,0.00 L0.00,0.00 Z" style="stroke: none; fill: #1d976c;"></path>
        </svg>
    </div>
    <div class="container">
        <div class="infoPrincipal">
            <!--=====================================
            MIGAS DE PAN
            ======================================-->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="menu.php">Administración</a></li>
                    <li class="breadcrumb-item"><a href="trasferencias.php">Transacciones Bancarias</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Cuentas Propias</li>
                </ol>
            </nav>
            <h1>Transacciones Bancarias A Cuentas Propias</h1><br>
            <div class="modContent">
                <div class="container">
                    <?php 
                    $cuentas = CuentasControlador::ctrMostrarcuentashabilitadas($_SESSION['id']);
                    if (count($cuentas) == 1) {
                    ?>
                    <p class="text-center">
                        <strong class="text-success">No hay suficientes cuentas propias</strong><br>   
                        <span class="">Actualmente  solo dispone de una cuenta y no es posible hacer transferencias entre la misma cuenta.</span>                             
                    </p>
                    <?php
                    }elseif(count($cuentas) == 0){
                    ?>
                    <p class="text-center">
                        <strong class="text-success">No hay existen cuentas registradas</strong><br>   
                        <span class="">Usted no posee ninguna cuenta asociada, para crear una cuenta diríjase a la opcion del panel de adminitracion <strong>Crear cuenta.</strong></span>                             
                    </p>
                    <?php
                    }else{
                    ?>
                    <form class="mt-10" id="formPropias" action="" method="post">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Cuenta origen *</span>
                                    </div>
                                    <select name="corigen" id="corigen" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required>
                                        <option value="" default>Seleccione de la lista</option>
                                        <?php foreach ($cuentas as $valor){?>
                                            <option value="<?= $valor['id']?>"><?= $valor['numero'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Cuenta destino *</span>
                                    </div>
                                    <select name="cdestino" id="cdestino" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required>
                                        <option value="" default>Seleccione de la lista</option>
                                        <?php foreach ($cuentas as $valor){?>
                                            <option value="<?= $valor['id']?>"><?= $valor['numero'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Monto *</span>
                                    </div>
                                    <input name="monto" id="monto" type="number" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required>
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center">
                            <input type="hidden" name="idUser" id="idUser" value="<?= $_SESSION['id'] ?>">
                            <input id="btn-trasferir" type="submit" class="btn btn-success" value="Transferir">                            
                        </div>
                    </form>
                    <?php
                    }
                    ?>                    
                </div>
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

    <script src="../vistas/js/transaciones.js"></script>
</body>

</html>