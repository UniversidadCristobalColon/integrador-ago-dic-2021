<?php
require_once '../../../../config/global.php';
require '../../../../config/db.php';
define('RUTA_INCLUDE', '../../../../');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <style>
        .valid {
            color: green;
        }

        .valid:before {
            position: relative;
            left: -35px;

        }

        .invalid {
            color: red;
        }

        .invalid:before {
            position: relative;
            left: -35px;

        }
    </style>

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
                        <label for = "inputnombre" >Nombre-*</label>
                        <input type = "text" class="form-control" name="nombre" required>
                    </div>
                    <div class = "form-group col-md-6">
                        <label for = "inputapellido">Apellidos-*</label>
                        <input type = "text" class="form-control" name="apellidos" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for = "inputcel">Celular-*</label>
                        <input type = "text" class="form-control" name="celular" required>
                    </div>
                    <div class = "form-group col-md-6">
                        <label for = "inputel">Tel??fono-*</label>
                        <input type = "text" class="form-control" name="telefono" required >
                    </div>
                    <div class="form-group col-md-6">
                        <label>Email-*</label>
                        <input type = "email" class="form-control" name="email1" required>
                    </div>
                </div>
                </fieldset>
                <fieldset>
                    <legend>Datos de Facturaci??n</legend>
                    <div class = "form-row">
                        <div class="form-group col-md-6">
                            <label>Raz??n Social</label>
                            <input type = "text" class="form-control" name="razon" >
                        </div>
                        <div class="form-group col-md-6">
                            <label>RFC</label>
                            <input type = "text" class="form-control" name="rfc" id="rfc" pattern="(?=.*[A-Z]).{13,}">
                            <div id="message">
                                <div id="capital" class="invalid">Letras mayusculas</div>
                                <div id="length" class="invalid"><b>Minimo 13 Caracteres</b></div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Email Secundario</label>
                            <input type = "email" class="form-control" name="email2">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Codigo Postal</label>
                            <input type = "text" class="form-control" name="cp">
                        </div>
                    </div>
                    <div class = "form-row">
                        <div class="form-group col-md-6">
                            <label>Calle</label>
                            <input type = "text" class="form-control" name="calle">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Entre calles</label>
                            <input type = "text" class="form-control" name="entrecalles">
                        </div>
                    </div>
                    <div class = "form-row">
                        <div class="form-group col-md-2">
                            <label>N??mero Exterior</label>
                            <input type = "text" class="form-control" name="numext">
                        </div>
                        <div class="form-group col-md-2">
                            <label>N??mero Interior</label>
                            <input type = "text" class="form-control" name="numint">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Colonia</label>
                            <input type = "text" class="form-control" name="colonia">
                        </div>
                            <div class="form-group col-md-6">
                                <label>Localidad</label>
                                <input type = "text" class="form-control" name="localidad">
                            </div>
                        <div class="form-group col-md-6">
                            <label>Municipio</label>
                            <input type = "text" class="form-control" name="municipio">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Estado</label>
                             <select name ='estado' class="form-control custom-select">
                             <option value = 0>Seleccione una opci??n</option>
                                 <?php
                                 $query = "SELECT * FROM estados";
                                 $ejecutar = mysqli_query($conexion,$query);
                                 ?>
                                 <?php
                                 foreach ($ejecutar as $opciones):
                                 ?>
                                  <option value="<?php echo $opciones['id']?>"><?php echo $opciones['estado']?></option>
                                 <?php endforeach ?>
                             </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Referencia</label>
                            <input type = "text" class="form-control" name="referencia">
                        </div>
                    </div>
                    <script src="rfc.js"></script>
            </form>
        </div>
        <!-- /.container -->

        <?php getFooter() ?>

    </div>
    <!-- /.content-wrappe -->

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
