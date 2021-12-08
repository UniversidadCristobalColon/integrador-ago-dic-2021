<?php

session_start();

if( !isset($_GET["estado"]) ) {
    if( isset($_GET["exito_catalogo_colonias"]) )
        header('location: index.php?estado=1&exito_catalogo_colonias='.$_GET["exito_catalogo_colonias"]);
    else if( isset($_GET["error_catalogo_colonias"]) )
        header('location: index.php?estado=1&error_catalogo_colonias='.$_GET["error_catalogo_colonias"]);
    else
        header('location: index.php?estado=1');
}

require_once '../../../../config/global.php';

define('RUTA_INCLUDE', '../../../../'); //ajustar a necesidad

include '../../../../config/db.php';

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
                    <li class="breadcrumb-item active" aria-current="page">Colonias</li>
                </ol>
            </nav>

            <?php

            if( isset($_GET["exito_catalogo_colonias"]) && !empty($_GET["exito_catalogo_colonias"])){
                $mensaje = "";
                switch ($_GET["exito_catalogo_colonias"]){
                    case "1":
                        $mensaje = "Colonia eliminada exitosamente";
                        break;
                    case "2":
                        $mensaje = "Colonia reactivada exitosamente";
                        break;
                    case "3":
                        $mensaje = "Colonia agregada exitosamente";
                        break;
                    case "4":
                        $mensaje = "Colonia editada exitosamente";
                        break;
                }
                ?>
                    <div class="alert alert-success" role="alert">
                        <i class="fas fa-check"></i> <?php echo $mensaje; ?>
                    </div>
                <?php
            }else if( isset($_GET["error_catalogo_colonias"]) && !empty($_GET["error_catalogo_colonias"]) ){
                $mensaje = "";
                switch ($_GET["exito_catalogo_colonias"]){
                    case "1":
                        $mensaje = "No se pudo eliminar la colonia, inténtelo más tarde";
                        break;
                    case "2":
                        $mensaje = "No se pudo reactivar la colonia, inténtelo más tarde";
                        break;
                    case "3":
                        $mensaje = "No se pudo agregar la colonia, favor de intentarlo más tarde";
                        break;
                    case "4":
                        $mensaje = "No se pudo editar la colonia, favor de intentarlo más tarde";
                        break;
                }
                ?>
                <div class="alert alert-danger" role="alert">
                    <i class="fas fa-exclamation-triangle"></i> <?php echo $mensaje; ?>
                </div>
                <?php
            }
            ?>

            <div class="row my-3">
                <div class="col text-right">
                    <a href="agregar.php" type="button" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo</a>
                </div>
            </div>

            <form id="form" action="index.php" method="get">
                <div class="row my-3">
                    <div class="col-sm-12 col-md-4 form-group">
                        <label for="estado">Estado</label>
                        <select class="custom-select" name="estado" id="estado">
                            <option value="" disabled selected></option>
                            <?php

                            $estados = [];

                            $query =    "SELECT * FROM `pakmail`.estados";

                            if ($result = mysqli_query($conexion, $query)) {
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <option <?php if(isset($_GET["estado"]) && $_GET["estado"] == $row["id"]) echo "selected"; ?> value="<?php echo $row["id"]; ?>"><?php echo $row["estado"]; ?></option>
                                    <?php
                                }
                            }

                            ?>
                        </select>
                    </div>
                    <?php

                    if( isset($_GET["estado"]) && !empty($_GET["estado"]) ){
                        ?>

                        <div class="col-sm-12 col-md-4 form-group">
                            <label for="municipio">Municipio</label>
                            <select required id="municipio" name="municipio" class="custom-select">
                                <option value="" disabled selected></option>
                                <?php

                                $municipios = [];
                                $estado = $_GET["estado"];

                                $query =    "SELECT * FROM `pakmail`.municipios WHERE id_estado = $estado order by municipio asc";

                                if ($result = mysqli_query($conexion, $query)) {
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <option <?php if(isset($_GET["municipio"]) && $_GET["municipio"] == $row["id"]) echo "selected"; ?> value="<?php echo $row["id"]; ?>"><?php echo $row["municipio"]; ?></option>
                                        <?php
                                    }
                                }

                                ?>
                            </select>
                        </div>

                        <?php
                    }

                    ?>
                </div>
            </form>

            <div class="table-responsive mb-3">
                <table class="table table-bordered dataTable">
                    <thead>
                    <tr>
                        <th>Colonia</th>
                        <th>CP</th>
                        <th>Tipo Asentamiento</th>
                        <th>Última modificación</th>
                        <th>Estatus</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Colonia</th>
                        <th>CP</th>
                        <th>Tipo Asentamiento</th>
                        <th>Última modificación</th>
                        <th>Estatus</th>
                        <th>Acciones</th>
                    </tr>
                    </tfoot>
                    <tbody>
                        <?php

                            if( isset($_GET["estado"]) && !empty($_GET["estado"]) ){

                                $colonias = [];
                                $estado = $_GET["estado"];


                                $query =    "SELECT c.id, c.cp, c.colonia, c.asentamiento, m.municipio, e.estado, c.creacion, c.actualizacion, c.status
                                        FROM `pakmail`.colonias c
                                        left join `pakmail`.municipios m on m.id = c.id_municipio 
                                        left join `pakmail`.estados e on e.id = m.id_estado
                                        where e.id = $estado
                                        order by c.id desc;";

                                if( isset($_GET["municipio"]) && !empty($_GET["municipio"]) ){
                                    $municipio = $_GET["municipio"];
                                    $query =    "SELECT c.id, c.cp, c.colonia, c.asentamiento, m.municipio, e.estado, c.creacion, c.actualizacion, c.status
                                        FROM `pakmail`.colonias c
                                        left join `pakmail`.municipios m on m.id = c.id_municipio 
                                        left join `pakmail`.estados e on e.id = m.id_estado
                                        where e.id = $estado and m.id = $municipio
                                        order by c.id desc;";
                                }

                                if ($result = mysqli_query($conexion, $query))
                                    while ($row = $result->fetch_assoc())
                                        array_push($colonias, $row);

                                function fecha($fecha): string
                                {
                                    if( $fecha == null )
                                        return "";
                                    $dateObject = new DateTime($fecha);
                                    return $dateObject->format('d-m-Y h:i A');
                                }

                                foreach($colonias as $colonia){

                                    $id = $colonia["id"];

                                    ?>
                                    <tr>
                                        <td><?php echo $colonia["colonia"]; ?></td>
                                        <td><?php echo $colonia["cp"]; ?></td>
                                        <td><?php echo $colonia["asentamiento"]; ?></td>
                                        <td><?php echo $colonia["actualizacion"] ? fecha($colonia["actualizacion"]) : fecha($colonia["creacion"]); ?></td>
                                        <td><?php echo $colonia["status"] == "A" ? "Activa" : "Inactiva"; ?></td>
                                        <td>
                                            <a href="./editar.php?id_colonia=<?php echo $id; ?>" class="btn btn-link btn-sm btn-sm">Editar</a>
                                            <?php echo $colonia["status"] == "A" ? "<a href='./eliminar.php?id=$id' class='btn btn-link btn-sm'>Eliminar</a>" : "<a href='./reactivar.php?id=$id' class='btn btn-link btn-sm'>Reactivar</a>"; ?>
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

<script>
    $("#estado,#municipio").change(function(){
        $("#form").submit();
    });
    window.history.replaceState({}, document.title, window.location.href.split("?")[0]);
</script>

</body>

</html>