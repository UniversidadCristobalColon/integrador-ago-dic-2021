<?php
require '../../../../config/db.php';
$id_tipopaquete = $_GET['id'];
$delete = "DELETE FROM tipos_paquetes WHERE id = $id_tipopaquete";
$resultado = mysqli_query($conexion, $delete);
if($resultado){
    header('location: index.php');
}

?>