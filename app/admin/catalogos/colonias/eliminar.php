<?php

session_start();

if( isset($_GET["id"]) && !empty($_GET["id"]) ){

    include '../../../../config/db.php';

    $id = $_GET["id"];
    $query = "update `pakmail`.colonias set status = 'B' where id = $id";

    if( $insert = mysqli_query($conexion,$query) ){
        echo '<meta http-equiv="refresh" content="0;url=index.php?exito_catalogo_colonias=1">';
    }else{
        echo '<meta http-equiv="refresh" content="0;url=index.php?error_catalogo_colonias=1">';
    }

}