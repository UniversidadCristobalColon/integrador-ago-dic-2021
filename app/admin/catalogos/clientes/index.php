<?php
//session_start();
require_once '../../../../config/global.php';
require '../../../../config/db.php';
$sql = "SELECT * FROM clientes";
$resultado = mysqli_query($conexion, $sql);
$clientes = array();
if($resultado){
    while($fila = mysqli_fetch_assoc($resultado)){
        $clientes[] = $fila;
    }
}
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
    <script>
        function confirmar(id){
            if(confirm('¿Estás seguro?')){
                window.location = 'borrarcliente.php?id=' + id;
            }
        }
    </script>
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
                </div>
            </div>

                    <?php
                    if(count($clientes) > 0){
                    ?>
            <div class="table-responsive mb-3">
                    <table class="table table-bordered dataTable">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Celular</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Celular</th>
                            <th>Acciones</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        <?php
                        foreach ($clientes as $c){
                        ?>
                        <tr>
                            <td><?php echo $c['nombre']?></td>
                            <td><?php echo $c['email']?></td>
                            <td><?php echo $c['celular']?></td>
                            <td><a href="form-actualizar.php?id=<?php echo $c['id'] ?>" class="btn btn-link btn-sm btn-sm">Editar</a>
                                <a href="#" onclick="confirmar('<?php echo $c['id'] ?>')" class="btn btn-link btn-sm">Eliminar</a>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                        </tbody>
                    </table>
                    <?php
                    }else{
                        echo "<h4 class ='text-center'>No hay clientes registrados aún</h4>";
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

<?php getBottomIncudes( RUTA_INCLUDE ) ?>
</body>

</html>
