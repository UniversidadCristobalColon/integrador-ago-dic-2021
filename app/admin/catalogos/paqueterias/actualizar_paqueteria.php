<?php
require_once '../../../../config/global.php';
require '../../../../config/db.php';
define('RUTA_INCLUDE', '../../../../'); //ajustar a necesidad
$paqueteria = '';
$website = '';
$domicilio = '';
$id_municipio='';


if(!empty($_GET['id'])){
    $id_paqueteria = $_GET['id'];
    $sql = "SELECT * FROM paqueterias WHERE id = '$id_paqueteria'";

    $resultado = mysqli_query($conexion,$sql);

    if ($resultado){
        $fila = mysqli_fetch_assoc($resultado);
        $id_paqueteria = $fila['id'];
        $paqueteria = $fila['paqueteria'];
        $website = $fila['website'];
        $domicilio = $fila['domicilio'];
        $id_municipio = $fila['id_municipio'];
    }

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
                    <li class="breadcrumb-item active" aria-current="page">Actualizar</li>
                </ol>
            </nav>


        </div>

        <!-- /.container-fluid -->

        <div class="container">
            <form action="guardar.php" method="post" enctype="multipart/form-data">
                <div class="row mb-5">
                    <div class="col">
                        <input type = "hidden" name="id_paqueteria" value="<?php echo $id_paqueteria ?>"/>
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
                            <input type = "text" class="form-control" name="paqueteria" required value="<?php echo $paqueteria ?>">
                        </div>
                        <div class = "form-group col-md-6">
                            <label for = "inputwebsite">Web Site*</label>
                            <input type = "text" class="form-control" name="website" required value="<?php echo $website ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for = "inputdomicilio">Domicilio*</label>
                            <input type = "text" class="form-control" name="domicilio" required value="<?php echo $domicilio ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Municipio*</label>
                            <select name="id_municipio" class="form-control" required>
                                <?php
                                $query = "SELECT * FROM municipios";
                                $ejecutar = mysqli_query($conexion,$query);
                                ?>

                                <?php
                                foreach ($ejecutar as $opciones):
                                ?>
                                <option value="<?php echo $opciones['id']?>"><?php echo $opciones['municipio']?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Estatus*</label>
                            <select name="status" class="form-control" required>
                                <option selected>A</option>
                                <option>B</option>
                            </select>
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