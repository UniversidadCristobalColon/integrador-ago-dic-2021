<?php
require '../../../../config/db.php';
$id_cliente = $_GET['id'];
$update = "UPDATE clientes c SET status = 'B' WHERE c.id = '$id_cliente'";
$update = mysqli_query($conexion, $update);
if($update == true){
    header('location: index.php');
}else{
    echo mysqli_error($conexion);
}
?>