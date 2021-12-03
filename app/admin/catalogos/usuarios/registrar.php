<?php

session_start();

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

    <div id="content-wrapper">

        <div class="container-fluid">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Sección</li>
                    <li class="breadcrumb-item active" aria-current="page">Nuevo Usuario</li>
                </ol>
            </nav>

            <?php

            if( isset($_SESSION["error_registro_usuario_pakmail"]) ){
                ?>
                    <div class="alert alert-danger" role="alert">
                        <i class="fas fa-exclamation-triangle"></i> <?php echo $_SESSION["error_registro_usuario_pakmail"]; ?>
                    </div>
                <?php
                unset($_SESSION["error_registro_usuario_pakmail"]);
            }

            if( isset($_SESSION["exito_registro_usuario_pakmail"]) ){
                ?>
                    <div class="alert alert-success" role="alert">
                        <i class="fas fa-check"></i> <?php echo $_SESSION["exito_registro_usuario_pakmail"]; ?>
                    </div>
                <?php
                unset($_SESSION["exito_registro_usuario_pakmail"]);
            }

            ?>

        </div>

        <!-- /.container-fluid -->

        <div class="container">

            <form id="registrar" autocomplete="off" method="post" action="registrarProceso.php">

                <div class="row mb-5">
                    <div class="col">
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                    <div class="col text-right">
                        <a href="index.php" type="button" class="btn btn-link">Cancelar</a>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="nombre">Nombre</label>
                        <input name="nombre" type="text" class="form-control" id="nombre">
                        <div class="invalid-feedback">Nombre requerido</div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="apellidos">Apellidos</label>
                        <input name="apellidos" type="text" class="form-control" id="apellidos">
                        <div class="invalid-feedback">Apellidos requeridos</div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="correo">Correo</label>
                    <input name="correo" type="text" class="form-control" id="correo">
                    <div class="invalid-feedback">Correo inválido</div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="celular">Celular</label>
                        <input name="celular" type="tel" class="form-control" id="celular">
                        <div class="invalid-feedback">Celular inválido (10 dígitos)</div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="telefono">Teléfono</label>
                        <input name="telefono" type="tel" class="form-control" id="telefono">
                        <div class="invalid-feedback">Teléfono inválido (10 dígitos)</div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="usuario">Usuario</label>
                    <input name="usuario" type="text" class="form-control" id="usuario">
                    <div class="invalid-feedback">Usuario obligatorio</div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="password">Contraseña</label>
                        <input name="password" type="password" class="form-control" id="password">
                        <div class="invalid-feedback">Contraseña obligatoria</div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="password">Repetir Contraseña</label>
                        <input name="password2" type="password" class="form-control" id="password2">
                        <div class="invalid-feedback">Contraseña inválida</div>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.container -->

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

<script src="./registrar.js"></script>

</body>

</html>
