<?php
require '../../../../config/db.php';
$id_cliente = 23;
$id_clientef = 4;
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$celular = $_POST['celular'];
$telefono = $_POST['telefono'];

//facturacion
$razon = $_POST['razon'];
$rfc = $_POST['rfc'];
$email1 = $_POST['email1'];
$email2 = $_POST['email2'];
$codigopostal = $_POST['cp'];
$calle = $_POST['calle'];
$entrecalles = $_POST['entrecalles'];
$numexterior = $_POST['numext'];
$numinterior = $_POST['numint'];
$colonia = $_POST['colonia'];
$localidad = $_POST['localidad'];
$municipio = $_POST['municipio'];
$estado = $_POST['estado'];
$referencia = $_POST['referencia'];


if(empty($id_cliente)){
    $query = "INSERT INTO clientes (id, nombre, apellidos, email, celular, telefono, creacion)
VALUES (null,'$nombre','$apellidos','$email1','$celular','$telefono',NOW())";

    $query2 = "INSERT INTO fiscales (id, id_cliente, rfc, razon, calle, num_exterior, 
num_interior, colonia, cp, localidad, municipio, id_estado, email1, email2, creacion, entrecalles, referencia,status)
VALUES (null, 1, '$rfc', '$razon', '$calle', '$numexterior', '$numinterior', '$colonia', 
'$codigopostal', '$localidad', '$municipio', '1', '$email1', '$email2', NOW(),'$entrecalles', '$referencia', 'A')";

}else{
    $query = "UPDATE clientes SET nombre = '$nombre', apellidos = '$apellidos', email =  '$email1', celular = '$celular', telefono = '$telefono'
 WHERE id = $id_cliente";
    $query2 = "UPDATE fiscales SET rfc = '$rfc', razon = '$razon', calle = '$calle', num_exterior = '$numexterior', num_interior = '$numinterior'
               , cp = '$codigopostal', email1 = '$email1', email2 = '$email2', entrecalles = '$entrecalles', referencia = '$referencia' WHERE id = $id_clientef";

    $resultado = mysqli_query($conexion, $query);
    $resultado2 = mysqli_query($conexion, $query2);

    if($resultado == true && $resultado2 == true){
        header('location: index.php');
    }else{
        echo mysqli_errno($conexion);
    }

}

$resultado = mysqli_query($conexion, $query);
$resultado2 = mysqli_query($conexion, $query2);

if($resultado == true && $resultado2 == true){
    header('location: index.php');
}else{
    echo mysqli_errno($conexion);
}