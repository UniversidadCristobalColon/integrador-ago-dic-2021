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
        <div class="card-header">Pakmail</div>
        <div class="card-body">
            <?php

            if(isset($_REQUEST["v"]) && $_REQUEST["v"]=="1"){
                ?>
                <div class="text-center mb-4">
                    <h4>Registro</h4>
                    <p>Su registró ha sido exitoso, debe confirmar su correo electrónico para poder usar la cuenta.</p>
                </div>


                <?php
            }else{
                ?>
                <div class="text-center mb-4">
                    <h4>Registro</h4>
                    <p>Hubo un error en el registro, intentelo nuevamente.</p>
                </div>


                <?php
            }

            ?>
            <div class="text-center">
                <a class="d-block small mt-3" href="index.php">Página de inicio</a>
            </div>
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
