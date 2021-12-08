<?php 


class clientes{


	
	var $id;	
	var $nombre;
	var $apellidos;	
	var $email;	
	var $celular;	
	var $telefono;	
	var $creacion;	
	var $actualizacion;	
	var $email_verificado;	
	var $email_verificado_fecha;


	function guardar(){
      include_once("DBConnect.php");
      $respuesta = 0;
      $conn = null;
      $conn = new DBConnect(); // se construye el objeto
      $conexion = $conn->connect(); //el objeto invoca mediante una flecha -> a la funcion connect escrita en DBConnect
      $stmt = null; 
      $query ="INSERT INTO clientes ( nombre,apellidos,email,creacion,email_verificado,celular,telefono) values ( '$this->nombre','$this->apellidos', '$this->email', NOW(),'N','000000','00000');";
      $stmt =  $conexion->prepare($query);
      $respuesta = $stmt->execute();
      $respuesta = $conexion->lastInsertId();
      return $respuesta;

   }	

   	function confirmar($id){
      include_once("DBConnect.php");
      $respuesta = 0;
      $conn = null;
      $conn = new DBConnect(); // se construye el objeto
      $conexion = $conn->connect(); //el objeto invoca mediante una flecha -> a la funcion connect escrita en DBConnect
      $stmt = null; 
      $query ="update clientes set  email_verificado='S',email_verificado_fecha = NOW() where id=".$id;

      $stmt =  $conexion->prepare($query);
      $respuesta = $stmt->execute();
      return $respuesta;

   }
}

/* */