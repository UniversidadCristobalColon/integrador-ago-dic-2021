<?php
require '../../../config/db.php';

$stat = $_POST['stat'];
$idEnv = $_POST['id'];

switch ($stat) {
    case 'C':
        $sql = "update envios set seguimiento='$stat',fecha_envio=NOW(),actualizacion=NOW() where id=$idEnv";
        break;
    case 'E':
        $sql = "update envios set seguimiento='$stat',fecha_entrega=NOW(),actualizacion=NOW() where id=$idEnv";
        break;
}
$resultado = mysqli_query($conexion, $sql);
if ($resultado) {
    header('location: index.php');
} else {
    echo mysqli_error($conexion);
}