<?php
require_once '../../../../config/global.php';


define('RUTA_INCLUDE', '../../../../'); //ajustar a necesidad
?>
<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo PAGE_TITLE ?></title>


    <?php getTopIncludes(RUTA_INCLUDE ) ?>
</head>

<body id="page-top">

<?php getNavbar() ?>

<div id="wrapper">

    <?php getSidebar() ?>

    <?php

    if(isset($_POST['mail_update'])) {
        require '../../../../config/db.php';

        $email=$_POST['email'];
        $password=$_POST['password'];

        $sql= "update serviciocorreos
                set  usuario='$email', password='$password'";

        $resultado=mysqli_query($conexion,$sql);

        if($resultado){

            echo '<script language="javascript">';
            echo 'alert("Credenciales actualizadas correctamente")';
            echo '</script>';
        }

    }
    ?>

    <div id="content-wrapper">

        <div class="container-fluid">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Admin</li>
                    <li class="breadcrumb-item active" aria-current="page">Configuración credenciales de correo</li>
                </ol>
            </nav>

            <!-- Page Content -->
            <h1>Credenciales de correo remitente</h1>
            <hr>
            <form role="form" method="post">
                <div class="form-row">

                    <div class="form-group col-md-3">
                        <label for="email">Nuevo correo de envio:</label>
                        <input type="email" class="form-control" id="email" name="email"
                               value="" maxlength="50">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="password">Contraseña:</label>
                        <input type="text" class="form-control" id="password" name="password"
                               value="" maxlength="50">
                    </div>

                </div>
                <div class="row">
                    <div class="col-sm-9 form-group">
                        <button type="submit" name="mail_update" class="btn-success
                        ">Actualizar</button>
                    </div>
                </div>
            </form>
        </div>
        <?php getFooter() ?>
    </div>
    <!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>
<?php getModalLogout() ?>

<?php getBottomIncudes( RUTA_INCLUDE ) ?>
</body>




</html>
