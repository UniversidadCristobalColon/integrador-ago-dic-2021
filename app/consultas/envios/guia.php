<?php
require '../../../config/db.php';

$guia = $_POST['guia'];
$env_id = $_POST['id'];

$sql = "update envios set guia='$guia' where id = '$env_id'";

$resultado = mysqli_query($conexion, $sql);

if ($resultado) {
    header('location: index.php');
} else {
    echo mysqli_error($conexion);
}
?>