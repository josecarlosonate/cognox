<?php
// Función que revisa que el usuario este autenticado
function isAuth(){    
    if(!isset($_SESSION['login'])) {
        header('Location: login.php');
        die();
    }
}