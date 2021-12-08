<?php
require_once '../../config/global.php';
require '../../config/db.php';

$id_cliente = $_SESSION['id_cliente'];
$sql = "select * from clientes where id = '$id_cliente'";
$resultado = mysqli_query($conexion, $sql);


if ($resultado) {
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $nombre = $fila['nombre'];
        $apellido = $fila['apellidos'];
        $email = $fila['email'];
        $celular = $fila['celular'];
        $telefono = $fila['telefono'];

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
                    <li class="breadcrumb-item">Mi perfil</li>
                    <li class="breadcrumb-item active" aria-current="page">Perfil</li>
                </ol>
            </nav>

            <!-- Page Content -->

            <div class="container">

                <div class="row mb-5">
                        <div class="col">
                            <a href="edit-cliente.php" class="btn btn-primary">Editar</a>
                        </div>
                        <div class="col text-right">
                            <a href="edit-contrasena.php" class="btn btn-primary">Cambiar Contraseña</a>
                        </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Nombre</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $nombre ?>"
                               placeholder="Nombre" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Apellidos</label>
                        <input type="text" name="apellido" class="form-control" value="<?php echo $apellido ?>"
                               placeholder="Apellido" readonly>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>E-mail</label>
                            <input type="email" name="email"
                                   class="form-control" value="<?php echo $email ?>" placeholder="Correo Electronico"
                                   readonly>
                        </div>
                    </div>
                </div>

                

                <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Celular</label>
                            <input type="number" name="celular" class="form-control" value="<?php echo $celular ?>"
                                   placeholder="Celular" readonly>
                        </div>
                    <div class="form-group col-md-6">
                        <label>Telefono</label>
                        <input type="number" name="telefono" class="form-control" value="<?php echo $telefono ?>"
                               placeholder="Telefono" readonly>
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

<?php getBottomIncudes(RUTA_INCLUDE) ?>
</body>

</html>
