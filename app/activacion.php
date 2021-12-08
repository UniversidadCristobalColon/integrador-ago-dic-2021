<?php
session_start();

include '../config/db.php';

if( !isset($_GET["activacion"]) || empty($_GET["activacion"]) || !isset($conexion) ){
    header('location: index.php');
}

$codigo = $_GET["activacion"];
$query = "update `pakmail`.empleados set email_verificado = 'S', email_verificado_fecha = now(), codigo_verificacion = null where codigo_verificacion='$codigo' ";

if( mysqli_query($conexion,$query) ) {
    if( mysqli_affected_rows($conexion) == 0 )
        header('location: index.php');
}

?>
<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Packmail</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin.css" rel="stylesheet">
    <link href="../img/favicon.jpg" rel="shortcut icon" type="image/png"/>

</head>

<body class="bg-dark">

<div class="container">
    <div class="card card-login mx-auto mt-5">
        <div class="card-header text-center">¡Activación!</div>
        <div class="card-body">
            <h5 class="text-center mb-4">Cuenta activada exitosamente</h5>
            <a class="btn btn-primary btn-block" href="index.php">Ingresar</a>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
