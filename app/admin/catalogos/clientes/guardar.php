<?php
require '../../../../config/db.php';

$query = "INSERT INTO clientes (id, nombre, apellidos, email, celular, telefono, creacion) 
VALUES (null,'Jazael','Garcia','jaza@gmail.com','2294857203','394829191',NOW())";

$resultado = mysqli_query($conexion, $query);

var_dump($resultado);
