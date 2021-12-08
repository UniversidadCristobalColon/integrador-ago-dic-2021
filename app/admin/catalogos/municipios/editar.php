<?php
require_once '../../../../config/global.php';
include '../../../../config/db.php';

if (!isset($_GET["id"]) || empty($_GET["id"]))
    header('location: index.php');
else {
    $id = $_GET["id"];
}
$query = "SELECT l.id, l.localidad, m.id id_municipio, m.municipio, l.creacion, l.actualizacion, l.status 
                                    FROM `pakmail`.localidades l
                                    LEFT JOIN municipios m ON m.id = l.id_municipio
                                    WHERE l.id = $id";

$ent = null;
if ($result = mysqli_query($conexion, $query))
    while ($row = $result->fetch_assoc())
        $ent = $row;

if ($ent == null)
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
                        <li class="breadcrumb-item">Localidades</li>
                        <li class="breadcrumb-item active" aria-current="page">Editar</li>
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
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="nombre">Localidad</label>
                            <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $ent["localidad"] ?>" required>
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="municipio">Municipio</label>
                            <select class="custom-select" name="municipio" id="municipio">
                                <?php
                                $query = "SELECT * FROM `pakmail`.municipios ORDER BY municipio";

                                if ($result = mysqli_query($conexion, $query)) {
                                    while ($row = $result->fetch_assoc()) {
                                ?>
                                        <option value="<?php echo $row["id"]; ?>" <?php echo $row["id"] == $ent["id_municipio"] ? "selected" : "" ?>><?php echo $row["municipio"]; ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                            <div class="invalid-feedback">Selecciona un estado</div>
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

    <?php getBottomIncudes(RUTA_INCLUDE) ?>
</body>

</html>