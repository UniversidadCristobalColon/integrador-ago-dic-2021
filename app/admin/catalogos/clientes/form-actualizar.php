<?php
require_once '../../../../config/global.php';
require '../../../../config/db.php';
define('RUTA_INCLUDE', '../../../../'); //ajustar a necesidad
$id_cliente = '';
$nombre = '';
$apellidos = '';
$celular = '';
$telefono = '';
$razon = '';
$rfc = '';
$email1 = '';
$email2 = '';
$codigopostal = '';
$calle = '';
$entrecalles = '';
$numeroexterior = '';
$numerointerior = '';
$colonia = '';
$localidad = '';
$municipio = '';
$estado = '';
$referencia = '';
if(!empty($_GET['id'])){
    $id_cliente = $_GET['id'];
    $sql = "SELECT * FROM clientes WHERE id = 23";
    $sql2 = "SELECT * FROM fiscales WHERE id = 4";

    $resultado = mysqli_query($conexion, $sql);
    $resultado2 = mysqli_query($conexion, $sql2);

    if($resultado){
        $fila = mysqli_fetch_assoc($resultado);
        $nombre = $fila['nombre'];
        $apellidos = $fila['apellidos'];
        $celular = $fila['celular'];
        $telefono = $fila['telefono'];
    }
    if($resultado2){
        $fila = mysqli_fetch_assoc($resultado2);
        $razon = $fila['razon'];
        $rfc = $fila['rfc'];
        $email1 = $fila['email1'];
        $email2 = $fila['email2'];
        $codigopostal = $fila['cp'];
        $calle = $fila['calle'];
        $entrecalles = $fila['entrecalles'];
        $numeroexterior = $fila['num_exterior'];
        $numerointerior = $fila['num_interior'];
        $colonia = $fila['colonia'];
        $localidad = $fila['localidad'];
        $municipio = $fila['municipio'];
        $estado = $fila['estado'];
        $referencia = $fila['referencia'];
    }
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
                    <li class="breadcrumb-item">Clientes</li>
                    <li class="breadcrumb-item active" aria-current="page">Nuevo</li>
                </ol>
            </nav>


        </div>

        <!-- /.container-fluid -->

        <div class="container">
            <form action="guardar.php" method="post" enctype="multipart/form-data">
                <div class="row mb-5">
                    <div class="col">
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                    <div class="col text-right">
                        <a href="index.php" class="btn btn-link">Cancelar</a>
                    </div>
                </div>
                <fieldset>
                    <legend>Datos generales</legend>
                    <div class = "form-row">
                        <div class="form-group col-md-6">
                            <label for = "inputnombre" >Nombre-*</label>
                            <input type = "text" class="form-control" name="nombre" required value="<?php echo $nombre ?>">
                        </div>
                        <div class = "form-group col-md-6">
                            <label for = "inputapellido">Apellidos-*</label>
                            <input type = "text" class="form-control" name="apellidos" required value="<?php echo $apellidos?>" >
                        </div>
                        <div class="form-group col-md-6">
                            <label for = "inputcel">Celular-*</label>
                            <input type = "text" class="form-control" name="celular" required value="<?php echo $celular ?>">
                        </div>
                        <div class = "form-group col-md-6">
                            <label for = "inputel">Teléfono-*</label>
                            <input type = "text" class="form-control" name="telefono" required value="<?php echo $telefono ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Email-*</label>
                            <input type = "email" class="form-control" name="email1" required value="<?php echo $email1 ?>" >
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Facturación</legend>
                    <div class = "form-row">
                        <div class="form-group col-md-6">
                            <label>Razón Social</label>
                            <input type = "text" class="form-control" name="razon" value="<?php echo $razon ?>"  >
                        </div>
                        <div class="form-group col-md-6">
                            <label>RFC</label>
                            <input type = "text" class="form-control" name="rfc" value="<?php echo $rfc ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Email Secundario</label>
                            <input type = "email" class="form-control" name="email2" value="<?php echo $email2 ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Codigo Postal</label>
                            <input type = "text" class="form-control" name="cp" value="<?php echo $codigopostal?>">
                        </div>
                    </div>
                    <div class = "form-row">
                        <div class="form-group col-md-6">
                            <label>Calle</label>
                            <input type = "text" class="form-control" name="calle" value="<?php echo $calle ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Entre calles</label>
                            <input type = "text" class="form-control" name="entrecalles" value="<?php echo $entrecalles ?>" >
                        </div>
                    </div>
                    <div class = "form-row">
                        <div class="form-group col-md-2">
                            <label>Número Exterior</label>
                            <input type = "text" class="form-control" name="numext" value="<?php echo $numeroexterior ?>" >
                        </div>
                        <div class="form-group col-md-2">
                            <label>Número Interior</label>
                            <input type = "text" class="form-control" name="numint"  value="<?php echo $numerointerior?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Colonia</label>
                            <input type = "text" class="form-control" name="colonia" value="<?php echo $colonia?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Localidad</label>
                            <input type = "text" class="form-control" name="localidad" value="<?php echo $localidad?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Municipio</label>
                            <input type = "text" class="form-control" name="municipio" value="<?php echo $municipio?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Estado</label>
                            <input type = "text" class="form-control" name="estado" value="<?php echo $estado ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Referencia</label>
                            <input type = "text" class="form-control" name="referencia" value="<?php echo $referencia?>">
                        </div>
                    </div>
            </form>
        </div>
        <!-- /.container -->

        <?php getFooter() ?>

    </div>
    <!-- /.content-wrapp -->

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