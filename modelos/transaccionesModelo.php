<?php

require_once "conexion.php";

class TransaccionesModelo
{
    /*=============================================
	OBTENER CUENTAS DE USUARIO
	=============================================*/
    static public function mdlMostrartransacciones($tabla,$idUser){

        $db = new Conexion();
        $stmt = $db->pdo->prepare("SELECT t.id,c.numero AS numeroCuenta, cd.numero AS numeroDestino,t.monto,t.fecha,t.tipo_trans
                                    FROM $tabla AS t
                                    INNER JOIN cuentas AS c ON t.c_origen = c.id
                                    INNER JOIN cuentas AS cd ON t.c_destino = cd.id
                                    WHERE c.usuario_id = :usuario_id");
        $stmt->bindParam(":usuario_id", $idUser, PDO::PARAM_INT);
		$stmt->execute();

        return $stmt -> fetchAll();
    }
}