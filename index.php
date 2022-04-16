<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE); 
require_once "controladores/inicioControlador.php";

$inicio = new ControladorInicio();

$inicio->inicio();