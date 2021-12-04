<?php
include_once("../models/clientes.php");
include_once("../models/usuarios.php");
$cli=new clientes();
$usu= new usuarios();
$cli->nombre = $_POST['txtNombre'];
$cli->apellidos= $_POST['txtApps'];
$cli->email= $_POST['txtEmail'];
$ra=$cli->guardar();
$usu->user=$_POST['txtEmail'];
$usu->password=$_POST["txtPwd"];
$usu->id_perfil=$ra;
$rA=$usu->guardar();
if($rA>0){
	





	header("Location: ../success.php?v=1");
}else{
	if($rA>0){
	header("Location: ../success.php?v=2");
}
}

?>
	
	