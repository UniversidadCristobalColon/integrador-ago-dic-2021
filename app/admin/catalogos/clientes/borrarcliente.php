<?php
require '../../../../config/db.php';
$id_cliente = $_GET['id'];
$update = "UPDATE clientes SET status = 'B' WHERE id = $id_cliente";
$update = mysqli_query($conexion, $update);
if($update == true){
    header('location: index.php');
}else{
    echo mysqli_error($conexion);
}
?>