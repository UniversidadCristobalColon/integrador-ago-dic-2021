<?php
require_once '../../../config/global.php';
require '../../../config/db.php';
define('RUTA_INCLUDE', '../../../'); //ajustar a necesidad
$id_cliente = 23;
?>
<?php
$sql = "SELECT cotiz.id_cotizacion AS id_cotizacion, CONCAT(cli.nombre, ' ', cli.apellidos) AS cliente,
    CONCAT(dir_rem.calle, ' #', dir_rem.num_exterior, ', Entre ', dir_rem.entre_calles, ' C.P. ', dir_rem.cp) AS dir_rem,
    CONCAT(dir_dest.calle, ' #', dir_dest.num_exterior, ', Entre ', dir_dest.entre_calles, ' C.P. ', dir_dest.cp) AS dir_dest,
    cotiz.tipo_servicio, cotiz.asegurado, cotiz.factura, cotiz.recoleccion, cotiz.fecha_creacion, cotiz.fecha_respuesta, cotiz.fecha_resolucion, cotiz.actualizacion, cotiz.guia, cotiz.status FROM cotizaciones cotiz INNER JOIN clientes cli ON cli.id = cotiz.id_cliente INNER JOIN direcciones dir_rem ON dir_rem.id = cotiz.id_dir_rem
    INNER JOIN direcciones dir_dest ON dir_dest.id = cotiz.id_dir_dest WHERE cotiz.id_cliente = $id_cliente;";
$result = mysqli_query($conexion, $sql);
$cotizaciones = array();
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $cotizaciones[] = $row;
    }
} else {
    mysqli_error($conexion);
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title><?php echo PAGE_TITLE ?></title>

    <?php getTopIncludes(RUTA_INCLUDE) ?>
</head>

<body id="page-top">

    <?php getNavbar() ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <div id="wrapper">

        <?php getSidebar() ?>

        <div id="content-wrapper">

            <div class="container-fluid">

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Cliente</li>
                        <li class="breadcrumb-item active" aria-current="page">Mis cotizaciones</li>
                    </ol>
                </nav>

                <!-- <div class="alert alert-success" role="alert">
                <i class="fas fa-check"></i> Mensaje de éxito
            </div>

            <div class="alert alert-danger" role="alert">
                <i class="fas fa-exclamation-triangle"></i> Mensaje de error
            </div> -->

                <div class="row my-3">
                    <div class="col text-right">
                        <button type="button" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo</button>
                    </div>
                </div>

                <div class="table-responsive mb-3">
                    <table class="table table-bordered dataTable">
                        <thead>
                            <tr>
                                <th>N. Orden</th>
                                <th>Fecha creación</th>
                                <th>Dirección</th>
                                <th>Tipo de servicio</th>
                                <th>Estatus</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>N. Orden</th>
                                <th>Fecha creación</th>
                                <th>Dirección</th>
                                <th>Tipo de servicio</th>
                                <th>Estatus</th>
                                <th>Acciones</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            foreach ($cotizaciones as $one) {
                            ?>
                                <tr>
                                    <td><?php echo $one['id_cotizacion'] ?></td>
                                    <td><?php echo $one['fecha_creacion'] ?></td>
                                    <td>Origen: <i><?php if (is_null($one['dir_rem'])) {
                                                        echo 'N/A';
                                                    } else {
                                                        echo $one['dir_rem'];
                                                    } ?>
                                        </i>
                                        <br>Destino: <i><?php echo $one['dir_dest'] ?></i>
                                    </td>
                                    <td><?php echo $one['tipo_servicio'] ?></td>
                                    <td>
                                        <?php if ($one['status'] == 0) { ?>
                                            Esperando respuesta...
                                        <?php } ?>
                                        <?php if ($one['status'] == 1) { ?>
                                            Seleccione una opción...
                                        <?php } ?>
                                        <?php if ($one['status'] == 2) { ?>
                                            Esperando GUÍA...
                                        <?php } ?>
                                        <?php if ($one['status'] == 3) { ?>
                                            Cotización resuelta.<br>Ya puede ver su guía.
                                        <?php } ?>
                                        <?php if ($one['status'] == 4) { ?>
                                            Borrado/Cancelado
                                        <?php } ?>
                                    </td>
                                    <td><a href="manage.php?id=<?php echo $one['id_cotizacion'] ?>" class="btn btn-link btn-sm btn-sm">Administrar</a></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

            </div>
            <!-- /.container-fluid -->

            <!-- myCustom Structure -->
            <!-- toast -->
            <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        <img src="..." class="rounded me-2" alt="...">
                        <strong class="me-auto">Bootstrap</strong>
                        <small>11 mins ago</small>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        Hello, world! This is a toast message.
                    </div>
                </div>
            </div>

            <?php
            if (isset($_GET['state'])) {
                if ($_GET['state'] == 'notFound') {
            ?>
                <script src="js/scriptIndex.js"></script>
                    <script>
                        showToast();
                    </script>
            <?php
                }
            }
            ?>

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