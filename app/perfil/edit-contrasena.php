<?php
require_once '../../config/global.php';
require '../../config/db.php';
//$id_cliente = 35;//$_SESSION['id_usuario'];



define('RUTA_INCLUDE', '../../'); //ajustar a necesidad
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


    <?php getTopIncludes(RUTA_INCLUDE) ?>
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
                    <li class="breadcrumb-item active" aria-current="page">Editar Contraseña</li>
                </ol>
            </nav>
            <!-- Page Content -->
            <div class="container">
                <form action="editar-con.php" method="post" enctype="multipart/form-data">


                    <div class="row mb-5">
                        <div class="col">
                            <button type="submit" class="btn btn-success">Actualizar</button>
                        </div>
                            <div class="col text-right">
                                <a href="mi-perfil.php" class="btn btn-link">Cancelar</a>
                            </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nueva Contraseña</label>
                                <input type="password" name="pass1" class="form-control" placeholder="Contraseña" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Confirmar Contraseña</label>
                                <input type="password" name="pass2" class="form-control" required>
                            </div>
                        </div>
                    </div>

                </form>
            </div>

        </div>
        <!-- /.container-fluid -->

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

<?php getBottomIncudes(RUTA_INCLUDE) ?>
</body>

</html>