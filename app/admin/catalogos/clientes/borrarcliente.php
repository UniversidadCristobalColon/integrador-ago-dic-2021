<?php
require '../../../../config/db.php';
$id_cliente = $_GET['id'];
$delete = "DELETE FROM clientes WHERE id = $id_cliente";
$delete2 = "DELETE FROM usuarios WHERE id_cliente = $id_cliente";
$delete3 = "DELETE FROM fiscales WHERE id_cliente = $id_cliente";
$resultado = mysqli_query($conexion, $delete);
$resultado2 = mysqli_query($conexion, $delete2);
$resultado3 = mysqli_query($conexion, $delete3);
if($resultado == true && $resultado2 == true && $resultado3 == true){
    header('location: index.php');
}else{
    echo mysqli_error($conexion);
}
?>