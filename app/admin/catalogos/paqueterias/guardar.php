<?php
require '../../../../config/db.php';
$id_paqueteria = $_POST['id_paqueteria'];

    $paqueteria = $_POST['paqueteria'];
    $website = $_POST['website'];
    $domicilio = $_POST['domicilio'];
    $alias = $_POST['alias'];
    $colonia = $_POST['colonia'];
    $calle = $_POST['calle'];
    $cd = $_POST['codigopostal'];
    $numerointerior = $_POST['numerointerior'];
    $numeroexterior = $_POST['numeroexterior'];
    $entrecalle = $_POST['entrecalle'];
    $referencia = $_POST['referencia'];
    $id_municipios = $_POST['id_municipio'];
    $status = $_POST['status'];

echo ($id_paqueteria);

if(empty($id_paqueteria)){
    $domicilio = "$alias  $colonia  $calle  $cd  $numerointerior  $numeroexterior  $entrecalle  $referencia";
    $query = "INSERT INTO paqueterias (id, paqueteria, website, creacion, status, domicilio,id_municipio)
VALUES (null,'$paqueteria','$website',NOW(),'A','$domicilio','$id_municipios')";

}else{
    $query = "UPDATE paqueterias SET paqueteria = '$paqueteria', website = '$website', actualizacion =  NOW(), domicilio = '$domicilio', id_municipio = '$id_municipios'
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
