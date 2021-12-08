<?php
error_reporting(0);
require_once '../../../config/global.php';
require '../../../config/db.php';

define('RUTA_INCLUDE', '../../../'); //ajustar a necesidad

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $where = "";
    $tipodeserv = $_POST['tiposerv'];
    $limite = $_POST['limite'];
    $fechas = $_POST['fecha'];

}

//funcion buscar
if (isset($_POST['buscar'])){
    if (($_POST['tiposerv'] OR $_POST['limite'] OR $_POST['fecha'])){
        $where="where tipo_servicio like '".$tipodeserv."%' and fecha_creacion like '".$fechas."%'";

    }
}

$query = "SELECT * FROM cotizaciones $where $limite";
$query2 = "SELECT * FROM envios";
$query3 = "SELECT cotiz.id_cotizacion, CONCAT(cli.nombre, ' ', cli.apellidos) AS cliente, CONCAT(dir_rem.calle, ' #', dir_rem.num_exterior, ', Entre ', dir_rem.entre_calles, ' C.P. ', dir_rem.cp) AS dir_rem, CONCAT(dir_dest.calle, ' #', dir_dest.num_exterior, ', Entre ', dir_dest.entre_calles, ' C.P. ', dir_dest.cp) AS dir_dest FROM cotizaciones cotiz INNER JOIN clientes cli ON cli.id = cotiz.id_cliente INNER JOIN direcciones dir_rem ON dir_rem.id = cotiz.id_dir_rem INNER JOIN direcciones dir_dest ON dir_dest.id = cotiz.id_dir_dest $where $limite";

$consulta = $conexion->query($query);
$consulta2 = $conexion->query($query2);
$consulta3 = $conexion->query($query3);


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
                    <li class="breadcrumb-item">Cotizaciones</li>
                    <li class="breadcrumb-item active" aria-current="page">Consultas cotizaciones</li>
                </ol>
            </nav>
        </div>

        <form method="post">
            <h10>Tipo de servicio:</h10>
            <select name="tiposerv">
                <option value="">Todos</option>
                <option value="Dia siguiente">Dia siguiente</option>
                <option value="Estandar">Estandar</option>
                <option value="Urgente">Urgente</option>
            </select>
            <h10>Fechas: </h10>
                <input name="fecha" type="date" value="fecha_creacion">
        <button type="submit" name="buscar" class="btn btn-primary">Buscar</button>
        <button type="button" class="btn btn-primary">Exportar a Excel</button>
        </form>

        <div class="table-responsive mt-5">
            <table class="table table-bordered dataTable">
                <thead>
                <tr>
                    <th>Tipo de servicio</th>
                    <th>Cliente</th>
                    <th>Direccion del destinatario</th>
                    <th>Fecha de creacion</th>
                </tr>
                </thead>
                <tbody>
                <?php
                while ($registro = $consulta->fetch_array(MYSQLI_BOTH) AND $registro3 = $consulta3->fetch_array()) {
                    echo '<tr>',
                        '<td>' . $registro['tipo_servicio'] . '</td>' .
                        '<td>' . $registro3['cliente'] . '</td>' .
                        '<td>' . $registro3['dir_dest'] . '</td>' .
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