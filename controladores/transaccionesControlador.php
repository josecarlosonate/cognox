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

}