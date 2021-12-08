<?php
//session_start();
require '../../../../config/db.php';
$id_cliente = $_POST['id_cliente'];
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
VALUES (null,'$nombre','$apellidos','$email1','$celular','$telefono',NOW())"; //ejecutar primero este
    $resultado = mysqli_query($conexion, $query);

    if($resultado == true){
        header('location: index.php');
        $sql = "SELECT id FROM clientes ORDER BY id DESC LIMIT 1";
        $datos = mysqli_query($conexion, $sql);

        while($row = mysqli_fetch_assoc($datos)){
            $idf = $row['id'];
        }
        $query2 = "INSERT INTO fiscales (id, id_cliente, rfc, razon, calle, num_exterior,
num_interior, colonia, cp, localidad, municipio, id_estado, email1, email2, creacion, entrecalles, referencia,status)
VALUES (null, '$idf', '$rfc', '$razon', '$calle', '$numexterior', '$numinterior', '$colonia', 
'$codigopostal', '$localidad', '$municipio', '$estado', '$email1', '$email2', NOW(),'$entrecalles', '$referencia', 'A')";
        $resultado = mysqli_query($conexion, $query2);

        if($resultado == true){
            $sql = "SELECT id FROM clientes ORDER BY id DESC LIMIT 1";
            $datos = mysqli_query($conexion, $sql);

            while($row = mysqli_fetch_assoc($datos)){
                $iduser = $row['id'];
            }
            $query3 = "INSERT INTO usuarios (id, id_cliente ,password, user, id_perfil) VALUES (null, $iduser, '', '$email1', 2)";
            $resultado = mysqli_query($conexion, $query3);
            $_SESSION['registro_exitoso'] = "Cliente agregado exitosamente";
        }

    }else{
        $_SESSION['guardar_error'] = "No se pudo agregar el usuario";
        echo mysqli_errno($conexion);
    }

}else{
    $query = "UPDATE clientes SET nombre = '$nombre', apellidos = '$apellidos', email =  '$email1', celular = '$celular', telefono = '$telefono'
 WHERE id = $id_cliente";//update del cliente elegido del catalogo
    $query2 = "UPDATE fiscales SET rfc = '$rfc', razon = '$razon', calle = '$calle', num_exterior = '$numexterior', num_interior = '$numinterior'
              ,colonia = '$colonia' , cp = '$codigopostal', localidad = '$localidad', municipio = '$municipio',id_estado = '$estado', email1 = '$email1', email2 = '$email2', entrecalles = '$entrecalles', referencia = '$referencia' WHERE id_cliente = $id_cliente";
//lo mismo para fiscales que el anterior de elegir el id segun el catalogo
    $query3 = "UPDATE usuarios SET user = '$email1' WHERE id_cliente = $id_cliente";
    $resultado = mysqli_query($conexion, $query);
    $resultado2 = mysqli_query($conexion, $query2);
    $resultado3 = mysqli_query($conexion, $query3);

    if($resultado == true){
        header('location: index.php');

    }else{
        $_SESSION['actualizar_error']=1;
        echo mysqli_errno($conexion);
    }

}
