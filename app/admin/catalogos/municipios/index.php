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
                        <li class="breadcrumb-item active" aria-current="page">Municipios</li>
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

                <div class="col-sm-12 col-md-4 form-group pl-0">
                    <label for="estado">Estado</label>
                    <select class="custom-select" name="estado" id="estado">
                        <option value="" selected></option>
                        <?php

                        $estados = [];

                        $query =    "SELECT * FROM `pakmail`.estados";

                        if ($result = mysqli_query($conexion, $query)) {
                            while ($row = $result->fetch_assoc()) {
                        ?>
                                <option <?php if (isset($_GET["estado"]) && $_GET["estado"] == $row["id"]) echo "selected"; ?> value="<?php echo $row["id"]; ?>"><?php echo $row["estado"]; ?></option>
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
                                <th>Municipio</th>
                                <th>Estado</th>
                                <th>Creación</th>
                                <th>Actualización</th>
                                <th>Estatus</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="bodyEstados" class="d-none">
                            <?php

                            $estados = [];

                            $query = "SELECT m.id, m.municipio, e.estado, m.creacion, m.actualizacion, m.status 
                                    FROM `pakmail`.municipios m
                                    LEFT JOIN estados e ON e.id = m.id_estado";

                            if ($result = mysqli_query($conexion, $query)) {
                                while ($row = $result->fetch_assoc()) {
                            ?>
                                    <tr>
                                        <?php $id = $row["id"]; ?>
                                        <td><?php echo $row["municipio"]; ?></td>
                                        <td><?php echo $row["estado"]; ?></td>
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

        $("#bodyEstados").removeClass("d-none");
        
        $("#estado").change(() => {
            let thisvalue = $("#estado option:selected").text();
            if (thisvalue != "") {
                $("#bodyEstados").removeClass("d-none")
                $("#table_info").removeClass("d-none")
                $("#table_paginate").removeClass("d-none")
                table.columns(1).search(thisvalue).draw();
            } else {
                table.columns(1).search("o9i8uyaeyf890wy89fy8ry").draw();
            }
        });

        $("#estado").trigger('change');

    });

</script>