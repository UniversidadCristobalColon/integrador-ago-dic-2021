<?php
require_once '../../../../config/global.php';

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
                    <li class="breadcrumb-item active" aria-current="page">Usuarios Pakmail</li>
                </ol>
            </nav>

            <div class="row my-3">
                <div class="col text-right">
                    <a href="./registrar.php" type="button" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo</a>
                </div>
            </div>

            <div class="table-responsive mb-3">
                <table class="table table-bordered dataTable">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Celular</th>
                        <th>Verificado</th>
                        <th>Última modificación</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Celular</th>
                        <th>Verificado</th>
                        <th>Última modificación</th>
                        <th>Acciones</th>
                    </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        include '../../../../config/db.php';
                        $query = "select * from `pakmail`.clientes";
                        if ($result = mysqli_query($conexion, $query)) {
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                    <tr>
                                        <td><?php echo $row["nombre"]; ?></td>
                                        <td><?php echo $row["apellidos"]; ?></td>
                                        <td><?php echo $row["email"]; ?></td>
                                        <td><?php echo $row["telefono"]; ?></td>
                                        <td><?php echo $row["celular"]; ?></td>
                                        <td><?php echo $row["email_verificado"] == "N" ? "No" : "Si" ?></td>
                                        <td><?php echo $row["actualizacion"] ? $row["actualizacion"] : $row["creacion"]; ?></td>
                                        <td>
                                            <a href="#" class="btn btn-link btn-sm">Editar</a>
                                            <a href="#" class="btn btn-link btn-sm">Eliminar</a>
                                        </td>
                                    </tr>
                                <?php
                            }
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
