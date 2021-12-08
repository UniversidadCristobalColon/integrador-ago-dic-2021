<?php
session_start();
require '../config/db.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pakmail</title>

    <!-- Custom fonts for this template-->
    <link href="../../../../Users/alex2/Desktop/proyectoaxel/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="../../../../Users/alex2/Desktop/proyectoaxel/css/sb-admin.css" rel="stylesheet">
    <link href="../../../../Users/alex2/Desktop/proyectoaxel/img/favicon.jpg" rel="shortcut icon" type="image/png"/>

</head>

<body class="bg-dark">

<div class="container">

    <div class="card card-login mx-auto mt-5">
        <div class="card-header">Recuperar contraseña</div>
        <div class="card-body">
            <div class="text-center mb-4">

                <h4>¿Olvidó su contraseña?</h4>
                <p>Se enviará un correo electrónico con instrucciones para recuperar el acceso a su cuenta.</p>
            </div>
            <!--agregue el metodo post al form-->
            <form method="post" action = "../config/correo.php">
                <div class="form-group">
                    <div class="form-label-group">
                        <!--cambie el nombre y id del input de correo-->

                        <input type="email" name="email_destino" id="email_destino" class="form-control" placeholder="Correo electrónico"
                               required="required" autofocus="autofocus">
                        <label for="email_destino">Correo electrónico</label>

                        <!--Agregue estos dos, el primero es titutlo de correo y segundo es el cuerpo, cambia el url al definitivo-->
                        <input id="subject" name="subject" type="hidden" value="Recuperación de contraseña">
                        <input id="message" name="message" type="hidden" value="<p>Ingrese en el siguiente <a href=http://localhost/integrador-ago-dic-2021/app/cambiar_password.php>link </a>para realizar el cambio de su contraseña</p>">


                    </div>
                </div>

                <button class="btn btn-primary btn-block" type="submit" name="sendmail">Recuperar</button>
            </form>
            <div class="text-center">
                <a class="d-block small mt-3" href="index.php">Página de inicio</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="../../../../Users/alex2/Desktop/proyectoaxel/vendor/jquery/jquery.min.js"></script>
<script src="../../../../Users/alex2/Desktop/proyectoaxel/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="../../../../Users/alex2/Desktop/proyectoaxel/vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>