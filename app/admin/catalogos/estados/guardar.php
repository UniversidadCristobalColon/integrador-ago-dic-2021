<?php
require '../../../../config/db.php';

$query = "INSERT INTO estados (id, estado, creacion, actualizacion, status) 
VALUES (null,$estado,NOW() ,NOW(),$status)";

$resultado = mysqli_query($conexion, $query);

var_dump($resultado);
