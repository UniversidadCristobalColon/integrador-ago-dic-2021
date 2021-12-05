<?php
require_once '../../../../config/global.php';
include '../../../../config/db.php';

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
                        <li class="breadcrumb-item">Catálogos</li>
                        <li class="breadcrumb-item active" aria-current="page">Localidades</li>
                    </ol>
                </nav>

                <?php

                if (isset($_GET["exito_catalogo"]) && !empty($_GET["exito_catalogo"])) {
                    $mensaje = "";
                    switch ($_GET["exito_catalogo"]) {
                        case "1":
                            $mensaje = "Eliminado exitosamente";
                            break;
                        case "2":
                            $mensaje = "Reactivado exitosamente";
                            break;
                        case "3":
                            $mensaje = "Agregado exitosamente";
                            break;
                        case "4":
                            $mensaje = "Editado exitosamente";
                            break;
                    }
                ?>
                    <div class="alert alert-success" role="alert">
                        <i class="fas fa-check"></i> <?php echo $mensaje; ?>
                    </div>
                <?php
                } else if (isset($_GET["error_catalogo"]) && !empty($_GET["error_catalogo"])) {
                    $mensaje = "";
                    switch ($_GET["error_catalogo"]) {
                        case "1":
                            $mensaje = "No se pudo eliminar, inténtelo más tarde";
                            break;
                        case "2":
                            $mensaje = "No se pudo reactivar, inténtelo más tarde";
                            break;
                        case "3":
                            $mensaje = "No se pudo agregar, favor de intentarlo más tarde";
                            break;
                        case "4":
                            $mensaje = "No se pudo editar, favor de intentarlo más tarde";
                            break;
                    }
                ?>
                    <div class="alert alert-danger" role="alert">
                        <i class="fas fa-exclamation-triangle"></i> <?php echo $mensaje; ?>
                    </div>
                <?php
                }
                ?>

                <!-- <div class="alert alert-danger" role="alert">
                  <i class="fas fa-exclamation-triangle"></i> Mensaje de error
              </div>-->

                <div class="row my-3">
                    <div class="col text-right">
                        <a href="agregar.php" class="btn btn-primary"><i class="fas fa-plus"></i>Nuevo</a>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4 form-group">
                    <label for="municipio">Municipio</label>
                    <select class="custom-select" name="municipio" id="municipio">
                        <option value="" selected></option>
                        <?php

                        $estados = [];

                        $query =    "SELECT * FROM `pakmail`.municipios";

                        if ($result = mysqli_query($conexion, $query)) {
                            while ($row = $result->fetch_assoc()) {
                        ?>
                                <option <?php if (isset($_GET["municipio"]) && $_GET["municipio"] == $row["id"]) echo "selected"; ?> value="<?php echo $row["id"]; ?>"><?php echo $row["municipio"]; ?></option>
                        <?php
                            }
                        }

                        ?>
                    </select>
                </div>

                <div class="table-responsive mb-3">
                    <table class="table table-bordered" id="table">
                        <thead>
                            <tr>
                                <th>Localidad</th>
                                <th>Municipio</th>
                                <th>Creación</th>
                                <th>Actualización</th>
                                <th>Estatus</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $estados = [];

                            $query = "SELECT l.id, l.localidad, m.municipio, l.creacion, l.actualizacion, l.status 
                                    FROM `pakmail`.localidades l
                                    LEFT JOIN municipios m ON m.id = l.id_municipio";

                            if ($result = mysqli_query($conexion, $query)) {
                                while ($row = $result->fetch_assoc()) {
                            ?>
                                    <tr>
                                        <?php $id = $row["id"]; ?>
                                        <td><?php echo $row["localidad"]; ?></td>
                                        <td><?php echo $row["municipio"]; ?></td>
                                        <td><?php echo $row["creacion"]; ?></td>
                                        <td><?php echo $row["actualizacion"] != null ? $row["actualizacion"] : ""; ?></td>
                                        <td><?php echo $row["status"] == "A" ? "Activa" : "Inactiva"; ?></td>
                                        <td>
                                            <a href="./editar.php?id=<?php echo $id; ?>" class="btn btn-link btn-sm btn-sm">Editar</a>
                                            <?php echo $row["status"] == "A" ? "<a href='./eliminar.php?id=$id' class='btn btn-link btn-sm'>Eliminar</a>" : "<a href='./reactivar.php?id=$id' class='btn btn-link btn-sm'>Reactivar</a>"; ?>
                                        </td>
                                    </tr>
                            <?php
                                }
                            }

                            ?>
                        </tbody>
                        <tfoot>
                            <tr></tr>
                        </tfoot>
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

    <?php getBottomIncudes(RUTA_INCLUDE) ?>
</body>

</html>

<script>
    var table;
    $(document).ready(function() {
        
        table = $('#table').DataTable({"language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            }});

        $("#municipio").change(() => {
            let thisvalue = $("select#municipio option:selected").text();
            table.columns(1).search(thisvalue).draw();
        });

    });
</script>