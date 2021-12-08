<?php

session_start();

if( isset($_GET["id"]) && !empty($_GET["id"]) ){

    include '../../../../config/db.php';

    $id = $_GET["id"];
    $query = "update `pakmail`.localidades set status = 'B', actualizacion = now() where id = $id";

    if( $insert = mysqli_query($conexion,$query) ){
        echo '<meta http-equiv="refresh" content="0;url=index.php?exito_catalogo=1">';
    }else{
        echo '<meta http-equiv="refresh" content="0;url=index.php?error_catalogo=1">';
    }

}