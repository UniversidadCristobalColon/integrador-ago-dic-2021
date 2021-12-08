<?php
require_once '../../../../config/global.php';
require '../../../../config/db.php';
define('RUTA_INCLUDE', '../../../../'); //ajustar a necesidad
$id_paquete = '';
$descripcion = '';
$tipo = '';
$estatus = '';
$peso = '';
$alto='';
$ancho='';
$largo='';

if(!empty($_GET['id'])){
    $id_paquete = $_GET['id'];
    $sql = "SELECT * FROM tipos_paquetes WHERE id = '$id_paquete'";

    $resultado = mysqli_query($conexion,$sql);

    if ($resultado){
        $fila = mysqli_fetch_assoc($resultado);
        $id_paquete = $fila['id'];
        $descripcion = $fila['descripcion'];
        $tipo = $fila['tipo'];
        $estatus = $fila['status'];
        $peso = $fila['peso'];
        $alto = $fila['alto'];
        $ancho = $fila['ancho'];
        $largo = $fila['largo'];

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
                    <li class="breadcrumb-item">Paquete</li>
                    <li class="breadcrumb-item active" aria-current="page">Actualizar</li>
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
                            <label for = "inputdescripcion" >Descripcion*</label>
                            <input type = "text" class="form-control" name="descripcion" required value="<?php echo $descripcion ?>">
                        </div>
                        <div class="form-group col-md-6">
                        <label>Tipo*</label>
                        <select name="tipo" class="form-control" required>
                            <option selected>Caja</option>
                            <option>Sobre</option>
                        </select>
                    </div>
                            <div class="form-group col-md-6">
                                <label for = "inputpeso" >Peso*</label>
                                <input type = "text" class="form-control" name="peso" required value="<?php echo $peso ?>">
                                <small class="text-muted" >Centímetros</small>
                            </div>
                        <div class="form-group col-md-6">
                                <label for = "inputalto" >Altura*</label>
                                <input type = "text" class="form-control" name="alto" required value="<?php echo $alto ?>">
                                <small class="text-muted" >Centímetros</small>
                            </div>
                        <div class="form-group col-md-6">
                            <label for = "inputancho" >Ancho*</label>
                            <input type = "text" class="form-control" name="ancho" required value="<?php echo $ancho ?>">
                            <small class="text-muted" >Centímetros</small>
                            </div>
                        <div class="form-group col-md-6">
                            <label for = "inputlargo" >Largo*</label>
                            <input type = "text" class="form-control" name="largo" required value="<?php echo $largo ?>">
                            <small class="text-muted" >Centímetros</small>
                            </div>
                    <div class="form-group col-md-6">

                        <input type = "hidden" class="form-control" name="id" required value="<?php echo $_GET['id']?>">
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