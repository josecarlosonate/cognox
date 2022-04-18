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

    /*=============================================
	OBTENER CUENTAS DE USUARIO HABILITADAS PARA TRNSACCIONES
	=============================================*/
    static public function ctrMostrarcuentashabilitadas($idUser){

        $tabla = "cuentas";
        return CuentasModelo::mdlMostrarcuentashabilitatas($tabla,$idUser);
        
    }

    /*=============================================
	OBTENER CUENTAS DE USUARIO HABILITADAS PARA TRNSACCIONES DE TERCEROS
	=============================================*/
    static public function ctrMostrarcuentashabilitadasterceros($idUser){

        $tabla = "cuentas";
        return CuentasModelo::mdlMostrarcuentashabilitadasterceros($tabla,$idUser);
        
    }

}