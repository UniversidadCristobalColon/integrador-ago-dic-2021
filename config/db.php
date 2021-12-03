<?php
$conexion = mysqli_connect('lizbethrojas.me', 'pakmail_user', 'kp3C-sd6WVvRZeBV', 'pakmail');

if ($conexion === false) { //¿error?
    exit('Error en la conexión con la bd');
}
mysqli_set_charset($conexion, 'utf8');
?>
