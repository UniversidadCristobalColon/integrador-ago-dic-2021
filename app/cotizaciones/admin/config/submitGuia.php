<?php
require '../../../../config/db.php';

$id_cotizacion = $_POST['id_cotizacion'];
$guia = $_POST['guia'];

$sqlUpdate = "UPDATE cotizaciones SET guia='$guia', status='3' WHERE id_cotizacion='$id_cotizacion'";
$resultado = mysqli_query($conexion, $sqlUpdate);
if ($resultado == true) {
    header('location: ../manage.php?id=' . $id_cotizacion);
} else {
    echo mysqli_error($conexion);
}

?>