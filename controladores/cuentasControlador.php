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

    /*=============================================
	CREAR CUENTA DE USUARIO
	=============================================*/
    static public function ctrCrearcuenta($data){

        $tabla = "cuentas";
        return CuentasModelo::mdlCrearcuenta($tabla,$data);
        
    }

    /*=============================================
	CAMBIO ESTADO CUENTA 
	=============================================*/
    static public function ctrEstadocuenta($id,$estado){

        $tabla = "cuentas";
        return CuentasModelo::mdlEstadocuenta($tabla,$id,$estado);
        
    }

}