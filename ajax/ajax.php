<?php
require_once "../controladores/loginControlador.php";

/* recibir accion */
if(isset($_POST["accion"])){

    // Iniciar sesion
    if($_POST["accion"] == 'inicio'){        
        $Data = json_decode($_POST['data'],true);
        $res = LoginControlador::ctrIniciarSesion($Data);  
        echo json_encode($res);
    }
}