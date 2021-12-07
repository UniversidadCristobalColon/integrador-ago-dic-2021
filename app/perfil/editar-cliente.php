<?php
require_once '../../config/global.php';
require '../../config/db.php';

$id_cliente = $_SESSION['id_cliente'];

$name = $_POST['name'];
$apellidos = $_POST['apellido'];
$celular = $_POST['celular'];
$telefono = $_POST['telefono'];


$query = "update clientes set nombre = '$name',apellidos= '$apellidos',
            celular= '$celular',
            telefono= '$telefono', actualizacion=NOW()
            where id='$id_cliente'";

$resultado = mysqli_query($conexion, $query);

if ($resultado == true) {
    header('location: index.php');
} else {
    echo mysqli_errno($conexion);
}


?>