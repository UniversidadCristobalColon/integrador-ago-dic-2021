<?php

require_once './functions.php';

if( isset($_GET["id"]) && !empty($_GET["id"]) ){
    if( reactivar_sucursal($_GET["id"]) )
        header('location: index.php?alert=true&message=Sucursal reactivada exitosamente');
    else
        header('location: index.php?alert=false&message=Hubo un error reactivando la sucursal, inténtelo más tarde');
}