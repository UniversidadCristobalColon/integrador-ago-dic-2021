<?php
require '../../../../config/db.php';

$query = "INSERT INTO paises (id, pais, creacion, actualizacion, status) 
VALUES (null,'México',NOW() ,NOW(),'A')";

$resultado = mysqli_query($conexion, $query);

var_dump($resultado);
