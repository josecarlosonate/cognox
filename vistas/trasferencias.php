<?php
require_once "../includes/funciones.php";
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
    <title>Transacciones Bancarias</title>
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
                    <li class="breadcrumb-item active" aria-current="page">Transacciones Bancarias</li>
                </ol>
            </nav>
            <h1>Transacciones Bancarias</h1>
            <div class="modContent">
                <div class="menuAdmin nav nav-pills">
                    <div class="option col-md-3 Administración">
                        <a data-toggle="tooltip" data-placement="right" title="Transacciones Bancarias cuentas propias"
                            href="propias.php">
                            <img src="../vistas/img/tras.png" alt="">
                            A cuentas propias
                        </a>
                    </div>
                    <div class="option col-md-3 Estampillas">
                        <a data-toggle="tooltip" data-placement="right" title="Transacciones Bancarias a otras cuentas"
                            href="terceros.php">
                            <img src="../vistas/img/money-transfer.png" alt="">
                            A cuentas de terceros
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>