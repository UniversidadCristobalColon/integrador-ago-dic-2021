<?php
require '../config/db.php';
$subject='Recuperación de contraseña';
$message='http://localhost/integrador-ago-dic-2021/app/cambiar_password.php'//link temporal prueba
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
            <form action="..\config/correo.php">
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="email" name="email_destino" id="inputEmail" class="form-control" placeholder="Correo electrónico"
                               required="required" autofocus="autofocus">
                        <label for="inputEmail">Correo electrónico</label>
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
