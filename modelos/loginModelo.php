<?php

require_once "conexion.php";

class LoginModelo
{
    /*=============================================
	INICIAR SESION
	=============================================*/

	static public function mdlIniciarSesion($tabla, $datos)
	{
        $db = new Conexion();
        
        /* verificar identificacion */
        $stmt = $db->pdo->prepare("SELECT * FROM $tabla WHERE  identificacion = :identificacion  ");
        $stmt->bindParam(":identificacion", $datos["user"], PDO::PARAM_INT);
		$stmt->execute();

		$info = $stmt->fetch();
        if($info){
            //si existe el usuario verifico la contraseña
            if(password_verify($datos["pass"],$info['password'])){
                //si todo salio bien 
                //crear variables de sesion
                session_start();    
                $_SESSION['id'] = $info['id'];
                $_SESSION['nombre'] = $info['nombres'];
                $_SESSION['apellido_paterno'] = $info['apellido_paterno'];
                $_SESSION['login'] = true;

                $res = array(
                    'code' => '200',
                    'msn' => 'Bienvenid@ '.$info['nombres'].' '.$info['apellido_paterno'],
                    'info' => $info
                );
            }else{
                $res = array(
                    'code' => '003',
                    'msn' => '¡Contraseña invalida!, por favor verifique',
                    'info' => $info['password']
                );
            }            
        }else{
            //No existe la identificacion del usuario
            $res = array(
                'code' => '002',
                'msn' => '¡Nuemero de identificación invalido!, por favor verifique',
                'info' => $info
            );
        }        
        return $res;
    }

}