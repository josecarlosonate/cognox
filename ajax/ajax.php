<?php
require_once "../controladores/loginControlador.php";
require_once "../controladores/cuentasControlador.php";
require_once "../controladores/transaccionesControlador.php";

/* recibir accion */
if(isset($_POST["accion"])){

    // Iniciar sesion
    if($_POST["accion"] == 'inicio'){        
        $Data = json_decode($_POST['data'],true);
        $res = LoginControlador::ctrIniciarSesion($Data);  
        echo json_encode($res);
    }

    // Crear cuenta
    if($_POST["accion"] == 'nuevaCuenta'){        
        $Data = json_decode($_POST['data'],true);
        
        // validaciones campos vacios
        if(empty(trim($Data['numeroCuenta']))){ //numero de cuenta vacia
            $res = array(
                'code' => '002',
                'msn' => '¡El campo Numero de cuenta no puede estar vacio!',
                'info' => $Data
            );
            echo json_encode($res);
        }
        if(empty(trim($Data['monto']))){ //numero de monto vacio
            $res = array(
                'code' => '002',
                'msn' => '¡El campo Monto no puede estar vacio!',
                'info' => $Data
            );
            echo json_encode($res);
        }
        if(empty(trim($Data['estado']))){ //numero de monto vacio
            $res = array(
                'code' => '002',
                'msn' => '¡El campo Estado no puede estar vacio!',
                'info' => $Data
            );
            echo json_encode($res);
        }
        
        //validaciones expresion regular
        if(preg_match('/^[a-zA-Z0-9-]+$/', $Data['numeroCuenta'])){
            //si pasa las validaciones
            $res = CuentasControlador::ctrCrearcuenta($Data);
            echo json_encode($res);
        }else{
            $res = array(
                'code' => '002',
                'msn' => '¡El campo Numero de cuenta no se aceptan caracteres especiales!',
                'info' => $Data
            );
            echo json_encode($res);
        }
    }

    //listar cuentas
    if($_POST["accion"] == 'lstCuentas'){
        $res = CuentasControlador::ctrMostrarcuentas($_POST['id']);
        echo json_encode($res);
    }

    //cambiar estado de cuenta
    if($_POST["accion"] == 'estadoCuenta'){
        echo CuentasControlador::ctrEstadocuenta($_POST['id'],$_POST['estado']);
    }

    //trasferir a cuentas propias
    if($_POST["accion"] == 'transferirPropia'){
        
        $Data = json_decode($_POST['data'],true);

        //Cuenta Origen y Cuenta destino iguales
        if($Data['corigen'] == $Data['cdestino']){
            $res = array(
                'code' => '002',
                'msn' => '¡El sistema detecta que la cuenta de origen y la cuenta de destino son iguales  deben ser distintas!',
                'info' => $Data
            );
            echo json_encode($res);
        }else{
            $res = TransaccionesControlador::ctrGuardartransaccionespropias($Data);  
            echo json_encode($res);
        }
    }
}
