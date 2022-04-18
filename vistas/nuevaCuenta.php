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
    <title>Nueva cuenta</title>
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
                    <li class="breadcrumb-item active" aria-current="page">Registrar nueva cuenta</li>
                </ol>
            </nav>
            <h1>Registrar nueva cuenta</h1>
            <div class="modContent">
                <div class="container">
                    <form id="formCuenta" action="" method="post">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Numero cuenta *</span>
                                    </div>
                                    <input name="numeroCuenta" id="numeroCuenta" type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Monto *</span>
                                    </div>
                                    <input name="monto" id="monto" type="number" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Estado</span>
                                    </div>
                                    <select name="estado" id="estado" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required>
                                        <option value="1" default>Habilitado</option>
                                        <option value="0">Inactivo</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="input-group input-group-sm mb-3">
                                    <input type="hidden" name="idUser" id="idUser" value="<?= $_SESSION['id'] ?>">
                                    <input id="btn-cuenta" type="submit" class="btn btn-success btn-sm" value="Registar Cuenta">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <hr class="mt-4">
                <div class="card" id="cardLst">
                    <div class="card-body">
                        <?php
                        $cuentas = CuentasControlador::ctrMostrarcuentas($_SESSION['id']);
                        if (!$cuentas) {
                        ?>
                            <p class="text-success">
                                <strong>Aún no hay cuentas propias registradas</strong>                                
                            </p>
                        <?php
                        } else {
                        ?>
                            <table id="lstCuentas" class="table">
                                <caption>Listado de cuentas propias creadas</caption>
                                <thead>
                                    <tr class="">
                                        <th scope="col">#</th>
                                        <th scope="col">Numero de cuenta</th>
                                        <th scope="col">Saldo</th>
                                        <th scope="col">Estado de cuenta</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="listadoCuentas">
                                    <?php
                                        $cont =1;
                                        foreach ($cuentas as $key => $valor) {?>
                                        <tr>
                                            <td><?= $cont ?></td>
                                            <td><?= $valor['numero'] ?></td>
                                            <td>$ <?= number_format($valor['valor'], 2, ',','.') ?></td>
                                            <td><?= $valor['estado'] == '1' ? 'Habilitada':'Deshabilitada' ?></td>
                                            <td>                                              
                                                <?php
                                                    if($valor['estado'] == '1'){
                                                        ?>
                                                        <button type="button" id="btnDeshabilitar" class="btn btn-danger">Deshabilitar</button>
                                                        <?php
                                                    }else{
                                                        ?>
                                                        <button type="button" id="habilitar" class="btn btn-primary">Habilitar</button>
                                                        <?php
                                                    }
                                                ?>
                                            </td>
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

    <script src="../vistas/js/plugins/jquery.validate.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script src="//cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

    <!--=====================================
    MI JAVASCRIPT
    ======================================-->

    <script src="../vistas/js/cuenta.js"></script>
</body>

</html>