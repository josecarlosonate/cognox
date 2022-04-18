<?php
require_once "../modelos/transaccionesModelo.php";

class TransaccionesControlador {

    /*=============================================
	OBTENER TRANSACCIONES DE USUARIO
	=============================================*/
    static public function ctrMostrartransacciones($idUser){

        $tabla = "transacciones";
        return TransaccionesModelo::mdlMostrartransacciones($tabla,$idUser);
        
    }

    /*=============================================
	REALIZAR TRANSACCIONES CUENTAS PROPIAS
	=============================================*/
    static public function ctrGuardartransaccionespropias($data){

        $tabla = "transacciones";
        $tablaC = "cuentas";
        return TransaccionesModelo::mdlGuardartransaccionespropias($tablaC,$tabla,$data);
        
    }

    /*=============================================
	REALIZAR TRANSACCIONES CUENTAS PROPIAS
	=============================================*/
    static public function ctrGuardartransaccionesterceros($data){

        $tabla = "transacciones";
        $tablaC = "cuentas";
        return TransaccionesModelo::mdlGuardartransaccionesterceros($tablaC,$tabla,$data);
        
    }

}