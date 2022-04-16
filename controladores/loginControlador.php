<?php
require_once "../modelos/loginModelo.php";

class LoginControlador {

    /*=============================================
	INICIAR SESION
	=============================================*/
    static public function ctrIniciarSesion($datos){

        $tabla = "usuarios";
        return LoginModelo::mdlIniciarSesion($tabla,$datos);
        
    }
}