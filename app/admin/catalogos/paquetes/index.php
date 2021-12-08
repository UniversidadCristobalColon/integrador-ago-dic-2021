<?php
require_once '../../../../config/global.php';

require '../../../../config/db.php';

define('RUTA_INCLUDE', '../../../../');

$sql = "SELECT * FROM tipos_paquetes";

$resultado = mysqli_query($conexion, $sql);

$tipos_paquetes = array();

if($resultado) {

    while ($fila = mysqli_fetch_assoc($resultado)) {
        $paqueterias[] = $fila;
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
                    <li class="breadcrumb-item">Catálogos</li>
                    <li class="breadcrumb-item active" aria-current="page">Tipos de Paquetes</li>
                </ol>
            </nav>

            <!--<div class="alert alert-success" role="alert">
                 <i class="fas fa-check"></i> Guardado Exitosamente
             </div> -->

            <!-- <div class="alert alert-danger" role="alert">
                  <i class="fas fa-exclamation-triangle"></i> Mensaje de error
              </div>-->

             <div class="row my-3">
                 <div class="col text-right">
                     <a href="nuevo_paquete.php" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo</a>
                 </div>
             </div>
            <?php
            if(count($paqueterias) > 0){
            ?>
             <div class="table-responsive mb-3">
                 <table class="table table-bordered dataTable">
                     <thead>
                     <tr>
                         <th>Descripcion</th>
                         <th>Tipo</th>
                         <th>Peso</th>
                         <th>Alto</th>
                         <th>Ancho</th>
                         <th>Largo</th>
                         <th>Estatus</th>
                         <th>Ultima Modificación</th>
                         <th>Acciones</th>


                     </tr>
                     </thead>
                     <tbody>
                     <?php
                     $contador = 0;
                     foreach ($paqueterias as $p){
                         $id = $p['id'];
                         ?>
                         <tr>
                             <td><?php echo $p['descripcion'] ?></td>
                             <?php
                             if($p['tipo'] == 'C'){
                                 $tipos = 'Caja' ;
                             }else{
                                 $tipos = 'Sobre';
                             }
                             ?>
                             <td><?php echo $tipos?></td>
                             <td><?php echo $p['peso'] ?></td>
                             <td><?php echo $p['alto']?></td>
                             <td><?php echo $p['ancho'] ?></td>
                             <td><?php echo $p['largo']?></td>
                             <?php
                             if($p['status'] == 'A'){
                                 $estatus = 'Activo' ;
                             }else{
                                 $estatus = 'Desactivado';
                             }
                             ?>
                             <td><?php echo $estatus?></td>
                             <?php
                             if(empty($p['actualizacion'])){
                                 $actual = $p['creacion'];
                             }else{
                                 $actual = $p['actualizacion'];
                             }
                             ?>
                             <td><?php echo $actual ?></td>

                             <td>
                                 <a href="actualizar_paquete.php?id=<?php echo $p['id'] ?>" class="btn btn-link btn-sm btn-sm">Editar</a>

                                 <?php echo $p["status"] == "A" ? "<a href='./eliminar.php?id= $id ' class='btn btn-link btn-sm'>Eliminar</a>" : "<a href='./reactivar.php?id=$id' class='btn btn-link btn-sm'>Reactivar</a>"; ?>
                             </td>
                         </tr>
                         <?php
                     }
                     ?>
                     </tbody>
                 </table>
                 <?php
              }else{
              echo "<h4 class ='text-center'>No hay diferentes paquetes </h4>";
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