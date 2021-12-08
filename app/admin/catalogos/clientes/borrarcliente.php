<?php
require '../../../../config/db.php';
$id_cliente = $_GET['id'];
$update1 = "UPDATE clientes c SET status = 'B' WHERE c.id = '$id_cliente'";
$update2 = "UPDATE fiscales b SET status = 'B' WHERE b.id_cliente = '$id_cliente'";
$r1 = mysqli_query($conexion, $update1);
$r2 = mysqli_query($conexion, $update2);
if($update1 == true && $update2 == true){
    header('location: index.php');
}else{
    echo mysqli_error($conexion);
}
?>