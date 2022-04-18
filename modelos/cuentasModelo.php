<?php

require_once "conexion.php";

class CuentasModelo
{
    /*=============================================
	OBTENER CUENTAS DE USUARIO
	=============================================*/
    static public function mdlMostrarcuentas($tabla,$idUser){

        $db = new Conexion();
        $stmt = $db->pdo->prepare("SELECT * FROM $tabla WHERE  usuario_id = :usuario_id ");
        $stmt->bindParam(":usuario_id", $idUser, PDO::PARAM_INT);
		$stmt->execute();

        return $stmt -> fetchAll();
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

    /*=============================================
	CAMBIO ESTADO CUENTA 
	=============================================*/
    static public function mdlEstadocuenta($tabla,$id,$estado){

        $db = new Conexion();
        $stmt = $db->pdo->prepare("UPDATE $tabla SET estado = :estado WHERE id = :id");

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->bindParam(":estado", $estado, PDO::PARAM_INT);
		$nReg = $stmt->execute();

		if ($nReg > 0) {
			return 'ok';
		} else {
			return 'error';
		}
    }

    /*=============================================
	OBTENER CUENTAS DE USUARIO HABILITADAS PARA TRNSACCIONES
	=============================================*/
    static public function mdlMostrarcuentashabilitatas($tabla,$idUser){

        $db = new Conexion();
        $stmt = $db->pdo->prepare("SELECT * FROM $tabla WHERE  usuario_id = :usuario_id AND estado = 1");
        $stmt->bindParam(":usuario_id", $idUser, PDO::PARAM_INT);
		$stmt->execute();

        return $stmt -> fetchAll();
    }

    /*=============================================
	OBTENER CUENTAS DE USUARIO HABILITADAS PARA TRNSACCIONES DE TERCEROS
	=============================================*/
    static public function mdlMostrarcuentashabilitadasterceros($tabla,$idUser){

        $db = new Conexion();
        $stmt = $db->pdo->prepare("SELECT * FROM $tabla WHERE  usuario_id != :usuario_id AND estado = 1");
        $stmt->bindParam(":usuario_id", $idUser, PDO::PARAM_INT);
		$stmt->execute();

        return $stmt -> fetchAll();
    }

}