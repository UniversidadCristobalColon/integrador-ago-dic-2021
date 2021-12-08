<?php
require_once '../../config/global.php';
require '../../config/db.php';
$id_proposito = $_GET['id'];

if (empty($id_proposito)) {
    $id_usuario = $_POST['usuario'];
    $descripcion = $_POST['descripcion'];
    $query = "insert into notificaciones(id, descripcion ,id_usuario, status ,leida, creacion) 
              values (null,'$descripcion','$id_usuario','A','N',NOW())";
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