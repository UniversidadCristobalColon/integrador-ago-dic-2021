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
      $query ="INSERT INTO usuarios (user,password,id_perfil,creacion,id_cliente) values ( '$this->user','".password_hash($this->password,PASSWORD_DEFAULT)."', 2, NOW(),'$this->id_perfil');";
      $stmt =  $conexion->prepare($query);
      $respuesta = $stmt->execute();
      $query = "INSERT INTO fiscales (id,id_cliente,rfc,razon,calle,num_exterior,num_interior,cp,localidad,municipio,id_estado,email1,email2,creacion,actualizacion,status,entrecalles,referencia) values (null,$this->user,'','','','','','','','','',null,'','', NOW(),null,'A','','')";
    $stmt =  $conexion->prepare($query);
    $respuesta = $stmt->execute();
      return $respuesta;

   }	
}

//* *//
