<?php
$conexion = mysqli_connect('35.202.106.35', 'icave_eval_360', 'pjQdOp2B3VPnQ3bU', 'icave_eval_360');

if ($conexion === false) { //¿error?
    exit('Error en la conexión con la bd');
}
mysqli_set_charset($conexion, 'utf8');
?>
