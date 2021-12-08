<?php
if( isset($_GET["id"]) && !empty($_GET["id"]) ) {

    include '../../../../config/db.php';

    $id = $_GET["id"];
    $query = "update tipos_paquetes set status = 'A' where id = $id";

    if ($insert = mysqli_query($conexion, $query)) {
        header('location: index.php');
    } else {

    }
}
?>