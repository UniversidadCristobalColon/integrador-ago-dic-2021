<?php
require_once '../../../config/global.php';
require '../../../config/db.php';

$razon = $_POST['razon'];
$comment = $_POST['comment'];
$idEnv = $_POST['id_form_cancel'];
$idCli = $_POST['id_client_cancel'];
$type = $_POST['id_type_cancel'];
$mensaje = '';

$sql = "update envios set razon_cancela='$razon',comment_cancela='$comment',seguimiento='X',fecha_cancela=NOW(),actualizacion=NOW() where id=$idEnv";
$resultado = mysqli_query($conexion, $sql);
if ($resultado) {
    $mensaje = "Envío $idEnv cancelado";
    notificacion($idCli,$type,($mensaje));
    header('location: index.php');
} else {
    echo mysqli_error($conexion);
}