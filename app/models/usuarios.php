<?php 


class usuarios{

	var $id;	
	var $user;	
	var $password;	
	var $id_perfil;	
	var $creacion;
    var $id_cliente;


	function guardar(){
      include_once("DBConnect.php");
      $respuesta = 0;
      $conn = null;
      $conn = new DBConnect(); // se construye el objeto
      $conexion = $conn->connect(); //el objeto invoca mediante una flecha -> a la funcion connect escrita en DBConnect
      $stmt = null; 
      $query ="INSERT INTO usuarios (user,password,id_perfil,creacion,id_cliente) values ( '$this->user','".password_hash($this->password,PASSWORD_DEFAULT)."', 2, NOW(),'$this->id_cliente');";
      $stmt =  $conexion->prepare($query);
      $respuesta = $stmt->execute();

      return $respuesta;

   }	
}

//***//
