<?php
require_once '../../../../config/global.php';
require '../../../../config/db.php';

define('RUTA_INCLUDE', '../../../../'); //ajustar a necesidad

$id_estado = '';
$estado = '';

if (!empty($_GET['id'])){
    $id_estado = $_GET['id'];
    $sql = "SELECT * FROM estados WHERE id = $id_estado";
    $resultado = mysqli_query($conexion, $sql);

    if ($resultado){
        $fila = mysqli_fetch_assoc($resultado);
        $estado = $fila['estado'];

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
                    <li class="breadcrumb-item">Estados</li>
                    <li class="breadcrumb-item active" aria-current="page">Nuevo</li>
                </ol>
            </nav>

            <!-- <div class="alert alert-success" role="alert">
                 <i class="fas fa-check"></i> Mensaje de éxito
             </div>

             <div class="alert alert-danger" role="alert">
                 <i class="fas fa-exclamation-triangle"></i> Mensaje de error
             </div> -->


         </div>

         <!-- /.container-fluid -->

        <div class="container">
            <form action="guardar.php" method="post">
            <input type="hidden" name="id_estado" value="<?php echo $id_estado ?>" />
            <div class="row mb-5">
                <div class="col">
                    <input type="submit" name="accion" value="Guardar" class="btn btn-success"/>
                </div>
                <div class="col text-right">
                    <a href="index.php" class="btn btn-link">Cancelar</a>
                </div>
            </div>

            <form>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputEstado">Estado</label>
                        <input type="text"  name="estado" class="form-control" value="<?php echo $estado ?>" required>
                    </div>
            </form>
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
