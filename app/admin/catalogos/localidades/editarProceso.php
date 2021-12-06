<?php

include '../../../../config/db.php';

$id = $_POST["id"];
$nombre = $_POST["nombre"];
$municipio = $_POST["municipio"];
$status = $_POST["status"];

$query = "UPDATE `pakmail`.localidades SET localidad = '$nombre', id_municipio = '$municipio', status = '$status', actualizacion = now() WHERE id = '$id' ";

if( $insert = mysqli_query($conexion,$query) ){
    echo '<meta http-equiv="refresh" content="0;url=index.php?exito_catalogo=4">';
}else{
    echo '<meta http-equiv="refresh" content="0;url=index.php?error_catalogo=4">';
}