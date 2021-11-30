<?php
require_once '../../../../config/global.php';
require_once './functions.php';

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
                    <li class="breadcrumb-item">Catálogos</li>
                    <li class="breadcrumb-item active" aria-current="page">Sucursales</li>
                </ol>
            </nav>

            <?php
            if( isset($_GET["alert"]) && isset($_GET["message"]) && !empty($_GET["message"]) ){
                if( $_GET["alert"] ==  "true" ){
                    ?>
                    <div class="alert alert-success" role="alert">
                        <i class="fas fa-check"></i> <?php echo $_GET["message"]; ?>
                    </div>
                    <script>window.history.replaceState({}, document.title, window.location.href.split("?")[0]);</script>
                <?php
                }else if( $_GET["alert"] == "false" ){
                ?>
                    <div class="alert alert-danger" role="alert">
                        <i class="fas fa-exclamation-triangle"></i> <?php echo $_GET["message"]; ?>
                    </div>
                    <script>window.history.replaceState({}, document.title, window.location.href.split("?")[0]);</script>
                    <?php
                }
            }
            ?>

            <div class="row my-3">
                <div class="col text-right">
                    <a href="new.php" type="button" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo</a>
                </div>
            </div>

            <div class="table-responsive mb-3">
                <table class="table table-bordered dataTable">
                    <thead>
                    <tr>
                        <th>Sucursal</th>
                        <th>Domicilio</th>
                        <th>CP</th>
                        <th>Colonia</th>
                        <th>Localidad</th>
                        <th>Municipio</th>
                        <th>Alta</th>
                        <th>Modificación</th>
                        <th>Estatus</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Sucursal</th>
                        <th>Domicilio</th>
                        <th>CP</th>
                        <th>Colonia</th>
                        <th>Localidad</th>
                        <th>Municipio</th>
                        <th>Alta</th>
                        <th>Modificación</th>
                        <th>Estatus</th>
                        <th>Acciones</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    <?php
                    foreach(get_sucursales() as $sucursal){
                        $id = $sucursal["id"];
                        ?>
                        <tr>
                            <td><?php echo $sucursal["sucursal"]; ?></td>
                            <td><?php echo $sucursal["domicilio"]; ?></td>
                            <td><?php echo $sucursal["cp"]; ?></td>
                            <td><?php echo $sucursal["colonia"]; ?></td>
                            <td><?php echo $sucursal["localidad"]; ?></td>
                            <td><?php echo $sucursal["municipio"]; ?></td>
                            <td><?php echo get_parse_fecha($sucursal["creacion"]); ?></td>
                            <td><?php echo get_parse_fecha($sucursal["actualizacion"]); ?></td>
                            <td><?php echo $sucursal["status"] == "A" ? "Activa" : "Inactiva"; ?></td>
                            <td>
                                <a href="./new.php?id=<?php echo $id; ?>" class="btn btn-link btn-sm btn-sm">Editar</a>
                                <?php echo $sucursal["status"] == "A" ? "<a href='./delete.php?id=$id' class='btn btn-link btn-sm'>Eliminar</a>" : "<a href='./reactivar.php?id=$id' class='btn btn-link btn-sm'>Reactivar</a>"; ?>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
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

<?php getBottomIncudes( RUTA_INCLUDE ) ?>
</body>

</html>
