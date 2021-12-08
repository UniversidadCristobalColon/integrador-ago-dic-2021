<?php
session_start();
if (isset($_SESSION['email_destino'])){
    $email_destino=$_SESSION['email_destino'];
}else{
    $ruta='/integrador-ago-dic-2021/app/';
    header("location:{$ruta}index.php");
}

//echo $email_destino;
//echo $error_pass;
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
        <div class="card-header">Cambiar contraseña</div>
        <div class="card-body">
        <!--Empieza el form-->
            <form action="cambio_password.php" method="POST">

                <div class="form-group">
                    <div class="form-label-group">
                        <input type="password" name="pass1" id="inputPassword" class="form-control" placeholder="Contraseña"
                               required="required">
                        <label for="inputPassword">Ingrese la nueva contraseña</label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-label-group">
                        <input type="password" name="pass2" id="inputPassword" class="form-control" placeholder="Contraseña"
                               required="required">
                        <label for="inputPassword">Confirmar contraseña</label>
                    </div>
                </div>

                <button class="btn btn-primary btn-block"  type="submit">Confirmar</button>
                <?php
                if(isset($_SESSION['login_error'])==true && $_SESSION['login_error']==1){
                    $_SESSION['login_error']=0;
                    ?>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="alert alert-danger"><?php $error_pass =$_SESSION['error_pass'];
                                echo $error_pass?></div>
                        </div>
                    </div>

                    <?php
                }
                ?>
            </form>

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
