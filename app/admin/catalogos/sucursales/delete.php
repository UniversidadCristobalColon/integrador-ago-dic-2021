<?php

require_once './functions.php';

if( isset($_GET["id"]) && !empty($_GET["id"]) ){
    if( delete_sucursal($_GET["id"]) )
        header('location: index.php?alert=true&message=Sucursal eliminada exitosamente');
    else
        header('location: index.php?alert=false&message=Hubo un error eliminando la sucursal, inténtelo más tarde');
}