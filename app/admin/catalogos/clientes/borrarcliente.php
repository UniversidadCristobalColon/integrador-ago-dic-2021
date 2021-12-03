<?php
require '../../../../config/db.php';
$id_proposito = 22;
$id_propositof = 3;
$delete = "DELETE FROM clientes WHERE id = $id_proposito";
$resultado = mysqli_query($conexion, $delete);
if($resultado){
    header('location: index.php');
}
?>