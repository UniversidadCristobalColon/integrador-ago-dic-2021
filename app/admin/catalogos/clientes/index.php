<?php
require_once '../../../../config/global.php';
require '../../../../config/db.php';
$sql = "SELECT * FROM clientes WHERE id = 1";
$resultado = mysqli_query($conexion, $sql);
$clientes = array();
if($resultado){
    while($fila = mysqli_fetch_assoc($resultado)){
        $clientes[] = $fila;
    }
}
//pon el id de usuario en código duro por mientras.
//$sql = "SELECT * FROM "




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
                    <li class="breadcrumb-item active" aria-current="page">Clientes</li>
                </ol>
            </nav>

            <div class="row my-3">
                <div class="col text-right">
                    <a href="form-cliente.php" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo</a>
                    <?php
                    if(count($clientes) > 0){
                    ?>
                    <table class="table table-bordered dataTable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Celular</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Celular</th>
                            <th>Acciones</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        <?php
                        $contador = 0;
                        foreach ($clientes as $c){
                        ?>
                        <tr>
                            <td><?php echo ++$contador ?></td>
                            <td><?php echo $c['nombre']?></td>
                            <td><?php echo $c['email']?></td>
                            <td><?php echo $c['celular']?></td>
                            <!-- onclick="confirmar('<?php echo $c['id'] ?>')" -->
                            <td><a href="form-actualizar.php?id=<?php echo $c['id'] ?>" class="btn btn-link btn-sm btn-sm">Editar</a> <a href="#" class="btn btn-link btn-sm">Eliminar</a></td>
                        </tr>
                        <?php
                        }
                        ?>
                        </tbody>
                    </table>
                    <?php
                    }else{
                        echo "<h4 class ='text-center'>No hay propósitos </h4>";
                    }
                    ?>
                </div>
            </div>
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