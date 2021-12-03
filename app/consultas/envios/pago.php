<?php
require '../../../config/db.php';

$metodo_pago = $_POST['method'];
$idEnv = $_POST['id'];

$sql = "update envios set metodo_pago=$metodo_pago,fecha_pago=NOW(),actualizacion=NOW() where id=$idEnv";
$resultado = mysqli_query($conexion, $sql);
if($resultado){
    header('location: envio.php');
} else {
    echo mysqli_error($conexion);
}