<?php
require '../../../config/db.php';

$env_id = $_GET['id'];

$sql = "update envios set status='B' where id = '$env_id'";

$resultado = mysqli_query($conexion, $sql);

if ($resultado) {
    header('location: index.php');
} else {
    echo mysqli_error($conexion);
}
?>