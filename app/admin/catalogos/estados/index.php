<?php
require_once '../../../../config/global.php';
require '../../../../config/db.php';

define('RUTA_INCLUDE', '../../../../');

$sql = "SELECT * FROM estados";
$resultado = mysqli_query($conexion,$sql);

$estados = array();
if($resultado) {
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $estados[] = $fila;
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

    <script>
        function confirmar(){
            if(confirm('¿Estás seguro de desactivarlo?')){
                window.location = 'desactivar.php?id=' + id;
            }
        }
    </script>
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
                    <li class="breadcrumb-item active" aria-current="page">Estados</li>
                </ol>
            </nav>

            <!--<div class="alert alert-success" role="alert">
                 <i class="fas fa-check"></i> Guardado Exitosamente
             </div>

            <div class="alert alert-danger" role="alert">
                  <i class="fas fa-exclamation-triangle"></i> Mensaje de error
              </div>-->

             <div class="row my-3">
                 <div class="col text-right">
                     <a href="estados.php" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo</a>
                 </div>
             </div>

             <div class="table-responsive mb-3">
                 <table class="table table-bordered dataTable">
                     <thead>
                     <tr>
                         <th>#</th>
                         <th>Estados</th>
                         <th>Creación</th>
                         <th>Actualización</th>
                         <th>Estatus</th>
                         <th>Acciones</th>

                     </tr>
                     </thead>
                     <tfoot>
                     </tfoot>
                     <tbody>
                     <?php
                     $contador = 0;
                     foreach ($estados as $e){
                     ?>
                     <tr>
                         <td><?php echo ++$contador ?></td>
                         <td><?php echo $e['estado']?></td>
                         <td><?php echo $e['creacion']?></td>
                         <td><?php echo $e['actualizacion']?></td>
                         <td><?php echo $e['status']?></td>
                         <td><a href="estados.php?id=<?php echo $e['id']?>" class="btn btn-link btn-sm btn-sm">Editar</a> <a href="#" onclick="confirmar('<?php echo $e['id']?>')" href="desactivar.php?id=<?php echo $e['id']?>" class="btn btn-link btn-sm">Desactivar</a></td>
                     </tr>
                     <?php
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
</body>

</html>
