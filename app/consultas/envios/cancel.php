<?php
require '../../../config/db.php';

$razon = $_POST['razon'];
$comment = $_POST['comment'];
$idEnv = $_POST['id'];

$sql = "update envios set razon_cancela='$razon',comment_cancela='$comment',seguimiento='X',fecha_cancela=NOW(),actualizacion=NOW() where id=$idEnv";
$resultado = mysqli_query($conexion, $sql);
if ($resultado) {
    header('location: index.php');
} else {
    echo mysqli_error($conexion);
}