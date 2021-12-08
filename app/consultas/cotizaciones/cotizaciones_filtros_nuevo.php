<?php
error_reporting(0);
require_once '../../../config/global.php';
require '../../../config/db.php';

define('RUTA_INCLUDE', '../../../'); //ajustar a necesidad

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $where = "";
    $tipodeserv = $_POST['tiposerv'];
    $nombre = $_POST['name'];
    $muni = $_POST['mun'];
    $fechas = $_POST['fecha'];

}

//funcion buscar
if (isset($_POST['buscar'])) {
    if (($_POST['tiposerv'] or $_POST['fecha'] or $_POST['name'] or $_POST['mun'])) {
        $where = "where tipo_servicio like '" . $tipodeserv . "%' and fecha_creacion like '" . $fechas . "%' and CONCAT(cli.nombre, ' ', cli.apellidos) like '" . $nombre . "%' and municipio like '" . $muni . "%'";
    }
}

$query = "SELECT cotiz.id_cotizacion, CONCAT(cli.nombre, ' ', cli.apellidos) AS cliente,
         CONCAT(' C.P. ',
              dir_dest.cp)                    
         AS dir_dest,
           cotiz.tipo_servicio, cotiz.fecha_creacion,
       m.municipio,e.seguimiento
        , col.cp
         FROM cotizaciones cotiz
           INNER JOIN clientes cli ON cli.id = cotiz.id_cliente
           INNER JOIN direcciones dir_dest ON dir_dest.id = cotiz.id_dir_dest 
           INNER JOIN colonias col ON col.id = dir_dest.id_colonia
           INNER JOIN municipios m on col.id_municipio = m.id 
           INNER join envios e on cli.id = e.cliente $where";


$consulta = $conexion->query($query);
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
                    <li class="breadcrumb-item">Consultas</li>
                    <li class="breadcrumb-item active" aria-current="page">Cotizaciones</li>
                </ol>
            </nav>
            <form method="post" action="cotizaciones_filtros_nuevo.php">
                <div class="row  align-items-end">
                    <div class="col-md-2">
                        <label>Nombre:</label>
                        <input type="text" class="form-control" placeholder="Nombre" name="name"/>
                    </div>
                    <div class="col-md-2">
                        <label>Municipio:</label>
                        <input type="text" class="form-control" placeholder="Municipio" name="mun"/>
                    </div>
                    <div class="col-md-2">
                        <label>Tipo de servicio:</label>
                        <select name="tiposerv" class="form-control">
                            <option value="">Todos</option>
                            <option value="Dia siguiente">Dia siguiente</option>
                            <option value="Estandar">Estandar</option>
                            <option value="Urgente">Urgente</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label>Fechas: </label>
                        <input name="fecha" type="date" value="fecha_creacion" class="form-control">
                    </div>
                    <div class="col-md-1">
                        <button type="submit" name="buscar" class="btn btn-primary">Buscar</button>
                    </div>
                    <div class="col-md-1">
                        <button type="submit" class="btn btn-primary" formtarget="_blank"
                                formaction="CotizacionesExcel.php" formmethod="get">Exportar a Excel
                        </button>
                    </div>
                </div>
            </form>
            <br>
            <div class="table-responsive mb-2">
                <table class="table table-bordered dataTable">
                    <thead>
                    <tr>
                        <th>Tipo de servicio</th>
                        <th>Cliente</th>
                        <th>Seguimiento</th>
                        <th>Dirección del destinatario</th>
                        <th>Fecha de creación</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    while ($registro = $consulta->fetch_array()) {
                        echo '<tr>',
                            '<td>' . $registro['tipo_servicio'] . '</td>' .
                            '<td>' . $registro['cliente'] . '</td>' .
                            '<td>' . $registro['seguimiento'] . '</td>' .
                            '<td>' . $registro['municipio'] . '</td>' .
                            '<td>' . $registro['fecha_creacion'] . '</td>';
                    } ?>
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

<?php getBottomIncudes(RUTA_INCLUDE) ?>
</body>
</html>