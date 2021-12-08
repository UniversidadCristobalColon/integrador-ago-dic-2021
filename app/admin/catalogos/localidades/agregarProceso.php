<?php

include '../../../../config/db.php';

$nombre = $_POST["nombre"];
$municipio = $_POST["municipio"];

$query = "INSERT INTO `pakmail`.localidades (localidad, id_municipio, creacion) VALUES ('$nombre', '$municipio', now())";

if( $insert = mysqli_query($conexion,$query) ){
    
    echo '<meta http-equiv="refresh" content="0;url=index.php?exito_catalogo=3">';
}else{
    echo '<meta http-equiv="refresh" content="0;url=index.php?error_catalogo=3">';
}