<?php 


class usuarios{

	var $id;	
	var $user;	
	var $password;	
	var $id_perfil;	
	var $creacion;


	function guardar(){
      include_once("DBConnect.php");
      $respuesta = 0;
      $conn = null;
      $conn = new DBConnect(); // se construye el objeto
      $conexion = $conn->connect(); //el objeto invoca mediante una flecha -> a la funcion connect escrita en DBConnect
      $stmt = null; 
      $query ="INSERT INTO usuarios (user,password,id_perfil,creacion) values ( '$this->user','$this->password', '$this->id_perfil', NOW());";
      $stmt =  $conexion->prepare($query);
      $respuesta = $stmt->execute();
      return $respuesta;

   }	
}

