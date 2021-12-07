<?php
require_once '../../config/global.php';
require '../../config/db.php';

$id_usuario = $_SESSION['id_usuario'];

$pass1 = $_POST['pass1'];
$pass2 = $_POST['pass2'];
$validar = strlen($pass1);
/* $/id_usuario */

if ($pass2 === $pass1) {
    if ($validar >= 6) {

        $passHash = password_hash($pass1, PASSWORD_DEFAULT);

        $query = "UPDATE usuarios set password = '$passHash' ,actualizacion = NOW() where id = '$id_usuario' ";

        $resultado = mysqli_query($conexion, $query);

        if ($resultado == true) {
            header('location: index.php');
        } else {
            echo mysqli_errno($conexion);
        }

    } else {
        echo 'Ingrese una contraseña con 6 caracteres';
    }
} else {
    echo 'No coinciden las contraseñas';

}
?>
