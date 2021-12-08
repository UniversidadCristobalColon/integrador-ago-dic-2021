<?php
require_once '../../../../config/global.php';
include '../../../../config/db.php';

if( !isset($_GET["id"]) || empty($_GET["id"]) )
    header('location: index.php');
else {
 $id = $_GET["id"];
}
$query = "SELECT m.id, m.municipio, e.id id_estado, e.estado, m.creacion, m.actualizacion, m.status 
                                    FROM `pakmail`.municipios m
                                    LEFT JOIN estados e ON e.id = m.id_estado
                                    WHERE m.id = $id";
$ent = null;
if ($result = mysqli_query($conexion, $query))
    while ($row = $result->fetch_assoc())
        $ent = $row;

if( $ent == null )
    header('location: index.php');

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
                    <li class="breadcrumb-item">Municipios</li>
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

            <form id="form" method="post" autocomplete="off" action="editarProceso.php">
                <div class="row mb-5">
                    <div class="col">
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                    <div class="col text-right">
                        <a href="index.php" type="button" class="btn btn-link">Cancelar</a>
                    </div>
                </div>
                <div class="form-row">
                    <input type="hidden" name="id" id="id" value="<?php echo $ent["id"]; ?>">
                    <div class="form-group col-md-4 col-sm-12">
                        <label for="nombre">Municipio</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $ent["municipio"] ?>" required>
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
