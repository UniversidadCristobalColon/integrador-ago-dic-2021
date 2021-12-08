<?php
require_once '../../../config/global.php';
require '../../../config/db.php';

$stat = $_POST['stat'];
$idEnv = $_POST['id_form_stat'];
$idCli = $_POST['id_client_stat'];
$mensaje = '';

switch ($stat) {
    case 'P':
        $sql = "update envios set seguimiento='$stat',comment_cancela=null,razon_cancela=null,fecha_envio=null,fecha_entrega=null,fecha_cancela=null,actualizacion=NOW() where id=$idEnv";
        $mensaje = "Envío $idEnv en espera";
        break;
    case 'C':
        $sql = "update envios set seguimiento='$stat',fecha_envio=NOW(),actualizacion=NOW() where id=$idEnv";
        $mensaje = "Envío $idEnv en camino";
        break;
    case 'E':
        $sql = "update envios set seguimiento='$stat',fecha_entrega=NOW(),actualizacion=NOW() where id=$idEnv";
        $mensaje = "Envío $idEnv entregado";
        break;
}
$resultado = mysqli_query($conexion, $sql);
if ($resultado) {
    notificacion($idCli,2,($mensaje));
    header('location: index.php');
} else {
    echo mysqli_error($conexion);
}