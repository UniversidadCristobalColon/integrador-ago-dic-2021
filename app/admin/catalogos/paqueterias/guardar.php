<?php
require '../../../../config/db.php';

$query = "INSERT INTO paqueterias (id, paqueteria,website, creacion, actualizacion, status,domicilio,id_municipio) 
VALUES (null,'Amazon','https://www.amazon.com/',NOW() ,NOW() ,'A','Calle 1','1')";

$resultado = mysqli_query($conexion, $query);

var_dump($resultado);
