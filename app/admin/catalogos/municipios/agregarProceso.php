<?php

include '../../../../config/db.php';

$nombre = $_POST["nombre"];
$estado = $_POST["estado"];

$query = "INSERT INTO `pakmail`.municipios (municipio, id_estado) VALUES ('$nombre', '$estado')";

if( $insert = mysqli_query($conexion,$query) ){
    
    echo '<meta http-equiv="refresh" content="0;url=index.php?exito_catalogo=3">';
}else{
    echo '<meta http-equiv="refresh" content="0;url=index.php?error_catalogo=3">';
}