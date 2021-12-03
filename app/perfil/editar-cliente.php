<?php

require '../../config/db.php';


$name = $_POST['name'];
$apellidos = $_POST['apellido'];
$celular = $_POST['celular'];
$telefono = $_POST['telefono'];


$query = "update clientes set nombre = '$name',apellidos= '$apellidos',
            celular= '$celular',
            telefono= '$telefono', actualizacion=NOW()
            where id=4";

$resultado = mysqli_query($conexion, $query);

if ($resultado == true) {
    header('location: mi-perfil.php');
} else {
    echo mysqli_errno($conexion);
}


?>