<?php

include '../../../../config/db.php';

$id = $_POST["id"];
$nombre = $_POST["nombre"];
$cp = $_POST["cp"];
$sentamiento = $_POST["sentamiento"];
$estado = $_POST["estado"];
$municipio = $_POST["municipio"];

$query = "UPDATE `pakmail`.colonias SET colonia = '$nombre', asentamiento = '$sentamiento', cp = '$cp', id_municipio = '$municipio', actualizacion = now() WHERE id = '$id' ";

if( $insert = mysqli_query($conexion,$query) ){
    echo '<meta http-equiv="refresh" content="0;url=index.php?exito_catalogo_colonias=4">';
}else{
    echo '<meta http-equiv="refresh" content="0;url=index.php?error_catalogo_colonias=4">';
}

