<?php
require_once "../includes/funciones.php";
require_once "../controladores/cuentasControlador.php";
require_once "../controladores/transaccionesControlador.php";
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
    <title>Reporte transacciones</title>
    <!--=====================================
	HOJA DE CSS 
	======================================-->
    <link rel="stylesheet" href="../vistas/css/plugins/bootstrap4.min.css">
    <link rel="stylesheet" href="../vistas/css/estilo.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
</head>

<body>
    <nav class="navbar menu" aria-label="">
        <a id="navMenu" class="navbar-brand" href="/">
            AppBank
        </a>
        <div class="float-right pr-5">
            <p class="text-white"><?php echo $_SESSION['nombre'] . ' ' . $_SESSION['apellido_paterno'] ?></p>
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
                    <li class="breadcrumb-item active" aria-current="page">Reporte de transacciones</li>
                </ol>
            </nav>
            <h1>Reporte de Transacciones Bancarias</h1>
            <div class="modContent">
                <div class="card" id="cardLst">
                    <div class="card-body">
                        <?php
                        $transacciones = TransaccionesControlador::ctrMostrartransacciones($_SESSION['id']);
                        if (!$transacciones) {
                        ?>
                            <p class="text-success">
                                <strong>No existen registros de transacciones</strong>                                
                            </p>
                        <?php
                        } else {
                        ?>
                            <table id="lstReporte" class="table">
                                <caption>Reporte de transacciones</caption>
                                <thead>
                                    <tr class="">
                                        <th scope="col">#</th>
                                        <th scope="col">Cuenta origen</th>
                                        <th scope="col">Cuenta destino</th>
                                        <th scope="col">Monto de transacción</th>
                                        <th scope="col">Fecha de transacción</th>
                                        <th scope="col">Tipo de transacción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $cont =1;
                                        foreach ($transacciones as $key => $valor) {?>
                                        <tr>
                                            <td><?= $cont ?></td>
                                            <td><?= $valor['numeroCuenta'] ?></td>
                                            <td><?= $valor['numeroDestino'] ?></td>
                                            <td>$ <?= number_format($valor['monto'], 2, ',','.') ?></td>
                                            <td><?= date('d/m/Y h:i a', $valor['fecha']) ?></td>
                                            <td><?= $valor['tipo_trans'] == '1' ? 'A cuenta propia':'A cuenta tercero' ?></td>
                                        </tr>
                                    <?php 
                                        $cont++; 
                                        } ?>
                                </tbody>
                            </table>
                        <?php
                        }
                        ?>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--=====================================
	PLUGINS DE JAVASCRIPT
	======================================-->
    <script src="../vistas/js/plugins/jquery-3.5.1.slim.min.js"></script>

    <script src="../vistas/js/plugins/bootstrap4.min.js"></script>

    <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script src="//cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

    <!--=====================================
    MI JAVASCRIPT
    ======================================-->

    <script src="../vistas/js/reporte.js"></script>
</body>

</html>