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

    /*=============================================
	REALIZAR TRANSACCIONES CUENTAS PROPIAS
	=============================================*/
    static public function mdlGuardartransaccionespropias($tablaC,$tabla,$data){
        
        $db = new Conexion();
        
        //obtener saldo actual origen
        $stmt = $db->pdo->prepare("SELECT valor  FROM $tablaC  WHERE id = :id");
        $stmt->bindParam(":id", $data['corigen'], PDO::PARAM_INT);
        $stmt->execute();
        $saldo = $stmt ->fetch();
        $stmt = null;

        //obtener saldo actual destino
        $stmt = $db->pdo->prepare("SELECT valor  FROM $tablaC  WHERE id = :id");
        $stmt->bindParam(":id", $data['cdestino'], PDO::PARAM_INT);
        $stmt->execute();
        $saldoDestino = $stmt ->fetch();
        $stmt = null;

        //verificar fondos suficientes
        if((int)$data['monto'] > $saldo['valor']){

            $res = array(
                'code' => '002',
                'msn' => '¡La cuenta Origen no tiene saldo suficientes, el monto supera el saldo actual!',
                'info' => $data
            );

        }else{
            $nuevoSaldo = (int)$saldo['valor'] - (int)$data['monto'];
            $nuevoSaldoDestino = (int)$saldoDestino['valor'] + (int)$data['monto'];
            //insertar transacion
            try {
                //configurar zona horaria
                date_default_timezone_set('America/Bogota');
                $fecha = time();
                $db = new Conexion();
                $stmt = $db->pdo->prepare("INSERT INTO $tabla(c_origen,c_destino,monto,fecha,tipo_trans) VALUES (:c_origen,:c_destino,:monto,:fecha,:tipo_trans)");
                
                $tipo = 1;
                $stmt->bindParam(":c_origen", $data["corigen"], PDO::PARAM_INT);
                $stmt->bindParam(":c_destino", $data["cdestino"], PDO::PARAM_INT);
                $stmt->bindParam(":monto", $data["monto"], PDO::PARAM_INT);
                $stmt->bindParam(":fecha", $fecha, PDO::PARAM_INT);
                $stmt->bindParam(":tipo_trans", $tipo, PDO::PARAM_INT);
    
                $nReg = $stmt->execute();
                $stmt = null;
                if ($nReg > 0) {
                    //actualizar saldo origen
                    $stmt = $db->pdo->prepare("UPDATE $tablaC SET valor = :valor WHERE id = :id");

                    $stmt->bindParam(":valor", $nuevoSaldo, PDO::PARAM_INT);
                    $stmt->bindParam(":id", $data["corigen"], PDO::PARAM_INT);
                    $nReg = $stmt->execute();

                    if ($nReg > 0) {
                        //actualizar saldo destino
                        $stmt = $db->pdo->prepare("UPDATE $tablaC SET valor = :valor WHERE id = :id");

                        $stmt->bindParam(":valor", $nuevoSaldoDestino, PDO::PARAM_INT);
                        $stmt->bindParam(":id", $data["cdestino"], PDO::PARAM_INT);
                        $nReg = $stmt->execute();
                        if ($nReg > 0) {
                            $res = array(
                                'code' => '200',
                                'msn' => '¡Realizado con exito! ',
                                'info' => $data
                            );
                        }                        	
                    }
                    
                }else{
                    $res = array(
                        'code' => '002',
                        'msn' => '¡Error al registrar la transación!',
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
        }
        return $res;
        
    }

    /*=============================================
	REALIZAR TRANSACCIONES CUENTAS TERCEROS
	=============================================*/
    static public function mdlGuardartransaccionesterceros($tablaC,$tabla,$data){
        $db = new Conexion();
        
        //obtener saldo actual origen
        $stmt = $db->pdo->prepare("SELECT valor  FROM $tablaC  WHERE id = :id");
        $stmt->bindParam(":id", $data['corigen'], PDO::PARAM_INT);
        $stmt->execute();
        $saldo = $stmt ->fetch();
        $stmt = null;

        //obtener saldo actual destino
        $stmt = $db->pdo->prepare("SELECT valor  FROM $tablaC  WHERE id = :id");
        $stmt->bindParam(":id", $data['cdestino'], PDO::PARAM_INT);
        $stmt->execute();
        $saldoDestino = $stmt ->fetch();
        $stmt = null;

        //verificar fondos suficientes
        if((int)$data['monto'] > $saldo['valor']){

            $res = array(
                'code' => '002',
                'msn' => '¡La cuenta Origen no tiene saldo suficientes, el monto supera el saldo actual!',
                'info' => $data
            );

        }else{
            $nuevoSaldo = (int)$saldo['valor'] - (int)$data['monto'];
            $nuevoSaldoDestino = (int)$saldoDestino['valor'] + (int)$data['monto'];
            //insertar transacion
            try {
                //configurar zona horaria
                date_default_timezone_set('America/Bogota');
                $fecha = time();
                $db = new Conexion();
                $stmt = $db->pdo->prepare("INSERT INTO $tabla(c_origen,c_destino,monto,fecha,tipo_trans) VALUES (:c_origen,:c_destino,:monto,:fecha,:tipo_trans)");
                
                $tipo = 0;
                $stmt->bindParam(":c_origen", $data["corigen"], PDO::PARAM_INT);
                $stmt->bindParam(":c_destino", $data["cdestino"], PDO::PARAM_INT);
                $stmt->bindParam(":monto", $data["monto"], PDO::PARAM_INT);
                $stmt->bindParam(":fecha", $fecha, PDO::PARAM_INT);
                $stmt->bindParam(":tipo_trans", $tipo, PDO::PARAM_INT);
    
                $nReg = $stmt->execute();
                $stmt = null;
                if ($nReg > 0) {
                    //actualizar saldo origen
                    $stmt = $db->pdo->prepare("UPDATE $tablaC SET valor = :valor WHERE id = :id");

                    $stmt->bindParam(":valor", $nuevoSaldo, PDO::PARAM_INT);
                    $stmt->bindParam(":id", $data["corigen"], PDO::PARAM_INT);
                    $nReg = $stmt->execute();

                    if ($nReg > 0) {
                        //actualizar saldo destino
                        $stmt = $db->pdo->prepare("UPDATE $tablaC SET valor = :valor WHERE id = :id");

                        $stmt->bindParam(":valor", $nuevoSaldoDestino, PDO::PARAM_INT);
                        $stmt->bindParam(":id", $data["cdestino"], PDO::PARAM_INT);
                        $nReg = $stmt->execute();
                        if ($nReg > 0) {
                            $res = array(
                                'code' => '200',
                                'msn' => '¡Realizado con exito! ',
                                'info' => $data
                            );
                        }                        	
                    }
                    
                }else{
                    $res = array(
                        'code' => '002',
                        'msn' => '¡Error al registrar la transación!',
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
        }
        return $res;
    }

}