<?php
require_once '../../config/global.php';
require '../../config/db.php';
$id_proposito = $_GET['id'];

if (empty($id_proposito)) {
} else {
    $query = "update notificaciones set leida = 'S' ,leida_fecha= NOW() where id='$id_proposito'";
}

$resultado = mysqli_query($conexion, $query);


if ($resultado) {
    header('location: index.php');
} else {
    mysqli_errno($conexion);
}
?>