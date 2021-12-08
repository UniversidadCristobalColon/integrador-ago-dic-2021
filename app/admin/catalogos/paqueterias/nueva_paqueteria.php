<?php
require_once '../../../../config/global.php';
require '../../../../config/db.php';
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
                    <li class="breadcrumb-item">Paqueteria</li>
                    <li class="breadcrumb-item active" aria-current="page">Nueva</li>
                </ol>
            </nav>


        </div>

        <!-- /.container-fluid -->

        <div class="container">
            <form action="guardar.php" method="post" enctype="multipart/form-data">
                <div class="row mb-5">
                    <div class="col">
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                    <div class="col text-right">
                        <a href="index.php" class="btn btn-link">Cancelar</a>
                    </div>
                </div>
                <fieldset>
                    <legend>Datos generales</legend>
                    <div class = "form-row">
                        <div class="form-group col-md-6">
                            <label for = "inputpaqueteria" >Paqueteria*</label>
                            <input type = "text" class="form-control" name="paqueteria" required value="">
                        </div>
                        <div class = "form-group col-md-6">
                            <label for = "inputwebsite">Web Site*</label>
                            <input type = "text" class="form-control" name="website" required value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for = "inputalias">Alias*</label>
                            <input type = "text" class="form-control" name="alias" required value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for = "inputcolonia">Colonia*</label>
                            <input type = "text" class="form-control" name="colonia" required value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for = "inputcolonia">Calle*</label>
                            <input type = "text" class="form-control" name="calle" required value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for = "inputdomicilio">Código Postal*</label>
                            <input type = "text" class="form-control" name="codigopostal" required value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for = "inputdomicilio">Numero Interior*</label>
                            <input type = "text" class="form-control" name="numerointerior" required value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for = "inputdomicilio">Numero Exterior*</label>
                            <input type = "text" class="form-control" name="numeroexterior" required value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for = "inputentrecalles">Entre Calle*</label>
                            <input type = "text" class="form-control" name="entrecalle" required value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for = "inputreferencias">Referencia*</label>
                            <input type = "text" class="form-control" name="referencia" required value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for = "inputmunicipio">Municipio*</label>
                            <input type = "text" class="form-control" name="municipio" required value="">
                        </div>

                    </div>
                </fieldset>
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
</body>

</html>