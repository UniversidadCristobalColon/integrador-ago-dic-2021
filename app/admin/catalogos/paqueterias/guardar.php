<?php
require '../../../../config/db.php';
$id_paqueteria = $_POST['id_paqueteria'];

    $paqueteria = $_POST['paqueteria'];
    $website = $_POST['website'];
    $alias = $_POST['alias'];
    $colonia = $_POST['colonia'];
    $calle = $_POST['calle'];
    $cd = $_POST['codigopostal'];
    $numerointerior = $_POST['numerointerior'];
    $numeroexterior = $_POST['numeroexterior'];
    $entrecalle = $_POST['entrecalle'];
    $referencia = $_POST['referencia'];
    $municipio = $_POST['municipio'];

echo ($id_paqueteria);

if(empty($id_paqueteria)){
    $domicilio = "$calle  $entrecalle  $numeroexterior  $numerointerior  $colonia  $cd  $alias $referencia";
    $query = "INSERT INTO paqueterias (id, paqueteria, website, creacion, status, domicilio,municipio)
VALUES (null,'$paqueteria','$website',NOW(),'A','$domicilio','$municipio')";

}else{
    $domicilio = $_POST['domicilio'];
    $query = "UPDATE paqueterias SET paqueteria = '$paqueteria', website = '$website', actualizacion =  NOW(), domicilio = '$domicilio'
 WHERE id = $id_paqueteria";

    $resultado = mysqli_query($conexion, $query);


    if($resultado == true){
        header('location: index.php');
    }else{
        echo mysqli_error($conexion);
    }

}

$resultado = mysqli_query($conexion, $query);

if($resultado == true){
    header('location: index.php');
}else{
    echo mysqli_error($conexion);
}
