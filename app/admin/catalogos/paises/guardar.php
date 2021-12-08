<?php
require '../../../../config/db.php';

$id_pais = $_POST['id_pais'];
$pais    = $_POST['pais'];

if (empty($id_pais)){
$query = "insert into paises(id,pais)values (null,'$pais')";
}else{
    $query = "update paises set pais = '$pais'where id = $id_pais";
}
$resultado = mysqli_query($conexion, $query);

if($resultado){
    header('location: index.php');
}

?>
