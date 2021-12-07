<?php

include '../../../../config/db.php';

$nombre = $_POST["nombre"];
$cp = $_POST["cp"];
$sentamiento = $_POST["sentamiento"];
$estado = $_POST["estado"];
$municipio = $_POST["municipio"];

$query = "INSERT INTO `pakmail`.colonias (colonia, asentamiento, cp, id_municipio) VALUES ('$nombre','$sentamiento','$cp',$municipio)";

if( $insert = mysqli_query($conexion,$query) ){
    echo '<meta http-equiv="refresh" content="0;url=index.php?exito_catalogo_colonias=3">';
}else{
    echo '<meta http-equiv="refresh" content="0;url=index.php?error_catalogo_colonias=3">';
}

