<?php
session_start();
$_SESSION=array();
session_destroy();
/*Lógica para terminar la sesión del usuario*/
header("location: index.php");
?>