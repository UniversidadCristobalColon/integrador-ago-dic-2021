<?php
require '../../../../config/db.php';

$query = "INSERT INTO estados (id, estado, creacion, actualizacion, status) 
VALUES (null,'Veracruz',NOW() ,NOW() ,'B')";

$resultado = mysqli_query($conexion, $query);

var_dump($resultado);
