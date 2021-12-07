<?php
require '../../../../config/db.php';
$id_paqueteria = $_GET['id'];
$delete = "DELETE FROM paqueterias WHERE id = $id_paqueteria";
$resultado = mysqli_query($conexion, $delete);
if($resultado){
    header('location: index.php');
}

?>