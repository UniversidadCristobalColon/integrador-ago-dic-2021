<?php
require '../../../../config/db.php';

$id_estado = $_POST['id_estado'];
$estado    = $_POST['estado'];

if (empty($id_estado)){
$query = "insert into estados(id,estado)values (null,'$estado')";
}else{
    $query = "update estados set estado = '$estado'where id = $id_estado";
}
$resultado = mysqli_query($conexion, $query);

if($resultado){
    header('location: index.php');
}

?>