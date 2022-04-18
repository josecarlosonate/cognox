<?php

require_once "conexion.php";

class CuentasModelo
{
    /*=============================================
	OBTENER CUENTAS DE USUARIO
	=============================================*/
    static public function mdlMostrarcuentas($tabla,$idUser){
        return false;
    }

    /*=============================================
	CREAR CUENTA DE USUARIO
	=============================================*/
    static public function mdlCrearcuenta($tabla,$data){

        try {
            $db = new Conexion();
            $stmt = $db->pdo->prepare("INSERT INTO $tabla(numero,valor,estado,usuario_id) VALUES (:numero,:valor,:estado,:usuario_id)");

            $stmt->bindParam(":numero", $data["numeroCuenta"], PDO::PARAM_STR);
            $stmt->bindParam(":valor", $data["monto"], PDO::PARAM_INT);
            $stmt->bindParam(":estado", $data["estado"], PDO::PARAM_INT);
            $stmt->bindParam(":usuario_id", $data["idUser"], PDO::PARAM_INT);

            $nReg = $stmt->execute();

            if ($nReg > 0) {
                $res = array(
                    'code' => '200',
                    'msn' => '¡Nueva cuenta registrada con exito! ',
                    'info' => $data
                );			
            }else{
                $res = array(
                    'code' => '002',
                    'msn' => '¡Error al crear la nueva cuenta!',
                    'info' => $data
                );	
            }

        } catch (\Throwable $th) {
            $res = array(
                'code' => '002',
                'msn' => 'Error: '.$th,
                'info' => $data
            );
        }
        return $res;
    }

}