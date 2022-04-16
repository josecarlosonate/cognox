<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="pruena tecnica">
    <meta name="description" content="realizacion de prueba php">
    <meta name="keyword" content="prueba tecnica, php">
    <title>appBank</title>
    <!--=====================================
	HOJA DE CSS 
	======================================-->
    <link rel="stylesheet" href="vistas/css/plugins/bootstrap4.min.css">
    <link rel="stylesheet" href="vistas/css/estilo.css">
</head>

<body>
    <!-- Image and text -->
    <nav class="navbar navbar-light ">
        <a class="navbar-brand" href="/">
            AppBank
        </a>
    </nav>
    <div class="container">
        <div class="centrar">
            <img src="vistas/img/pay.svg" class="img-fluid" alt="bienvenida">
        </div>
        <section id="intro">
            <div class="intro-text">
                <h2>¿Quieres realizar tus transacciones bancarias?</h2>
                <p>En AppBank te ofrecemos una plataforma digital donde encontraras las herramientas que necesitas para realizar diferentes operaciones sobre las cuentas que posees en el banco.</p>
                <?php                
                session_start();
                if($_SESSION['login']){
                    ?> 
                    <a id="initial-button" href="vistas/menu.php" class="btn-get-started" style="visibility: visible; animation-name: fadeInUp;">Ingresar al panel de administración</a>
                    <?php
                }else{
                    ?> 
                    <a id="initial-button" href="vistas/login.php" class="btn-get-started" style="visibility: visible; animation-name: fadeInUp;">Iniciar Sesión</a>
                    <?php
                }
                ?>                
            </div>
        </section>
    </div>
    <br>
</body>

</html>