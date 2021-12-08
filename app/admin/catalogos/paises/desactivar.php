<?php
/*Lógica para desactivar un estado*/
require '../../../../config/db.php';

$pais = $_GET['id'];
$delete       = "delete from paises where id = $pais";
$resultado    = mysqli_query($conexion, $delete);

if($resultado){
    header('location: index.php');
}
?>
