<?php
session_start()

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
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin.css" rel="stylesheet">
    <link href="../img/favicon.jpg" rel="shortcut icon" type="image/png"/>

</head>

<body class="bg-dark">

<div class="container">
    <div class="card card-login mx-auto mt-5">
        <div class="card-header">¡Bienvenido!</div>
        <div class="card-body">
            <!--Empieza el form-->
            <form action="login.php" method="POST">
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Correo electrónico"
                               required="required" autofocus="autofocus">
                        <label for="inputEmail">Correo electrónico</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="password" name="pass" id="inputPassword" class="form-control" placeholder="Contraseña"
                               required="required">
                        <label for="inputPassword">Contraseña</label>
                    </div>
                </div>

                <button class="btn btn-primary btn-block"  type="submit">Ingresar</button>
                <a class="btn btn-secondary btn-block" href="registrar.php">¿No tiene una cuenta? Regístrese aquí</a>
                <!--Alerta error de datos-->
                <?php
                if(isset($_SESSION['login_error'])==true && $_SESSION['login_error']==1){
                    $_SESSION['login_error']=0;
                    ?>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="alert alert-danger">Usuario o contraseña incorrecta</div>
                        </div>
                    </div>

                    <?php
                }
                ?>
                <!--Termina alerta error de datos-->
            </form>
            <div class="text-center">
                <a class="d-block small mt-3" href="recuperar.php">¿Olvidó su contraseña?</a>
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