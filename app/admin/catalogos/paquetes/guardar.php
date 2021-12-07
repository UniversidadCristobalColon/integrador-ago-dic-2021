<?php
require '../../../../config/db.php';
$id_paquete = $_POST['id'];

$descripcion = $_POST['descripcion'];
$tipo = $_POST['tipo'];
$alto = $_POST['alto'];
$peso = $_POST['peso'];
$ancho = $_POST['ancho'];
$largo = $_POST['largo'];
$status = $_POST['status'];


if(empty($id_paquete)){
    $query = "INSERT INTO tipos_paquetes (id, descripcion,tipo, creacion,actualizacion, status, peso,alto,ancho,largo)
VALUES (null,'$descripcion','$tipo',NOW(),NULL,'A','$peso','$alto','$ancho','$largo')";

}else{
    $query = "UPDATE tipos_paquetes SET descripcion = '$descripcion', tipo = '$tipo', actualizacion =  NOW(),status = '$status', peso = '$peso', alto = '$alto', ancho = '$ancho', largo = '$largo'
 WHERE id = $id_paquete";

    $resultado = mysqli_query($conexion, $query);


    if($resultado == true){
        header('location: index.php');
    }else{
        echo mysqli_errno($conexion);
    }

}

$resultado = mysqli_query($conexion, $query);

if($resultado == true){
    header('location: index.php');
}else{
    echo mysqli_errno($conexion);
}