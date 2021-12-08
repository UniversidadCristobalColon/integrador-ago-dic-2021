<?php
require_once '../../config/global.php';
require '../../config/db.php';
$id_usuario = $_SESSION['id_usuario'];
$contenido = '';
$sql = "select * from notificaciones where id_usuario=$id_usuario";

$resultado = mysqli_query($conexion, $sql);

$proposito = array();


if ($resultado) {
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $proposito[] = $fila;
    }
}


define('RUTA_INCLUDE', '../../'); //ajustar a necesidad
?>
<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <script>
        function vistono(leida_fecha){
            if(leida_fecha == ' '){
                set color: grey;
            }else{
                ('td').css('color', 'grey');
            }

        }
    </script>
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
                    <li class="breadcrumb-item active" aria-current="page">Notificacion</li>
                </ol>
            </nav>
            <!-- Page Content -->
            <div class="table mb-3">
                <?php
                if (count($proposito) > 0) {
                    ?>
                    <table class="table table-bordered ">
                        <thead>
                        <tr>
                            <th>Descripcion</th>
                            <th>Notificacion Recibida</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($proposito as $propositos) {
                            if ($propositos['id_perfil'] == '1') {
                                ?>

                                <tr>
                                    <td id="descrip"><?php echo $propositos['descripcion'] ?></td>
                                    <td id="fecha"><?php echo $propositos['creacion'] ?></td>
                                    <td><a href="nuevanoti.php?id=<?php echo $propositos['id'] ?>"
                                           onclick="vistono('<?php echo $propositos['leida_fecha'] ?>')"
                                           class="btn btn-success btn-sm">Marcar como Leido</a></td>
                                </tr>
                                <?php
                            } else {
                                if ($propositos['id_perfil'] == '2') {
                                    ?>
                                    <tr>
                                        <td><?php echo $propositos['descripcion'] ?></td>
                                        <td><?php echo $propositos['creacion'] ?></td>
                                        <td><a href="nuevanoti.php?id=<?php echo $propositos['id'] ?>"
                                               onclick="vistono('<?php echo $propositos['leida_fecha'] ?>')"
                                               class="btn btn-success btn-sm">Marcar como Leido</a></td>
                                    </tr>
                                    <?php
                                }
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                    <?php
                } else {
                    echo "<h4 class='text-center'> No hay notificaciones </h4> ";
                }
                ?>
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