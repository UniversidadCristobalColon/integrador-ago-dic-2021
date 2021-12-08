<?php
/*Lógica para desactivar un estado*/
require '../../../../config/db.php';

$estado = $_GET['id'];
$delete       = "delete from estados where id = $estado";
$resultado    = mysqli_query($conexion, $delete);

if($resultado){
    header('location: index.php');
}
?>
