<?php

include '../../../../config/db.php';

$id = $_POST["id"];
$nombre = $_POST["nombre"];
$estado = $_POST["estado"];
$status = $_POST["status"];

$query = "UPDATE `pakmail`.municipios SET municipio = '$nombre', id_estado = '$estado', status = '$status', actualizacion = now() WHERE id = '$id' ";

if( $insert = mysqli_query($conexion,$query) ){
    echo '<meta http-equiv="refresh" content="0;url=index.php?exito_catalogo=4">';
}else{
    echo '<meta http-equiv="refresh" content="0;url=index.php?error_catalogo=4">';
}

