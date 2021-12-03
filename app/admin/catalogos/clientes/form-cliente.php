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
                    <li class="breadcrumb-item">Clientes</li>
                    <li class="breadcrumb-item active" aria-current="page">Nuevo</li>
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
                        <label for = "inputnombre" >Nombre*</label>
                        <input type = "text" class="form-control" name="nombre" required>
                    </div>
                    <div class = "form-group col-md-6">
                        <label for = "inputapellido">Apellidos*</label>
                        <input type = "text" class="form-control" name="apellidos" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for = "inputcel">Celular*</label>
                        <input type = "text" class="form-control" name="celular" required>
                    </div>
                    <div class = "form-group col-md-6">
                        <label for = "inputel">Teléfono*</label>
                        <input type = "text" class="form-control" name="telefono" required >
                    </div>
                </div>
                </fieldset>
                <fieldset>
                    <legend>Facturación</legend>
                    <div class = "form-row">
                        <div class="form-group col-md-6">
                            <label>Razón Social*</label>
                            <input type = "text" class="form-control" name="razon" required >
                        </div>
                        <div class="form-group col-md-6">
                            <label>RFC*</label>
                            <input type = "text" class="form-control" name="rfc" required >
                        </div>
                        <div class="form-group col-md-6">
                            <label>Email 1*</label>
                            <input type = "email" class="form-control" name="email1" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Email 2*</label>
                            <input type = "email" class="form-control" name="email2" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Codigo Postal*</label>
                            <input type = "text" class="form-control" name="cp" required>
                        </div>
                    </div>
                    <div class = "form-row">
                        <div class="form-group col-md-6">
                            <label>Calle*</label>
                            <input type = "text" class="form-control" name="calle" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Entre calles*</label>
                            <input type = "text" class="form-control" name="entrecalles" required>
                        </div>
                    </div>
                    <div class = "form-row">
                        <div class="form-group col-md-2">
                            <label>Número Exterior*</label>
                            <input type = "text" class="form-control" name="numext" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label>Número Interior</label>
                            <input type = "text" class="form-control" name="numint">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Colonia*</label>
                            <input type = "text" class="form-control" name="colonia" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Localidad*</label>
                            <select name="localidad" class="form-control" required>
                                <option selected>Elegir...</option>
                                <option>Veracruz</option>
                            </select>

                        </div>
                        <div class="form-group col-md-6">
                            <label>Municipio*</label>
                            <select name="municipio" class="form-control" required>
                                <option selected>Elegir...</option>
                                <option>Veracruz</option>
                            </select>

                        </div>
                        <div class="form-group col-md-6">
                            <label>Estado*</label>
                            <select name="estado" class="form-control" required>
                                <option selected>Elegir...</option>
                                <option>Veracruz</option>
                            </select>

                        </div>
                        <div class="form-group col-md-6">
                            <label>Referencia</label>
                            <input type = "text" class="form-control" name="referencia">
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
</body>

</html>
