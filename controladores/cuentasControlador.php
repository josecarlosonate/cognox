<?php
require_once "../modelos/CuentasModelo.php";

class CuentasControlador {

    /*=============================================
	OBTENER CUENTAS DE USUARIO
	=============================================*/
    static public function ctrMostrarcuentas($idUser){

        $tabla = "cuentas";
        return CuentasModelo::mdlMostrarcuentas($tabla,$idUser);
        
    }
}