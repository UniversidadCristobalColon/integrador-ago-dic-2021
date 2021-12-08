<?php
require '../../../../config/db.php';

$query = "INSERT INTO paises (id, pais, creacion, actualizacion, status) 
VALUES (null,'Alemania',NOW() ,NOW(),'A')";

$resultado = mysqli_query($conexion, $query);

var_dump($resultado);
