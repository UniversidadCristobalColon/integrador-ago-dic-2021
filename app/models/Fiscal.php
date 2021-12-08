<?php

class Fiscal{


    var $id;
    var $id_cliente;
    var $rfc;
    var $razon;
    var $calle;
    var $num_exterior;
    var $num_interior;
    var $colonia;
    var $cp;
    var $localidad;
    var $municipio;
    var $id_estado;
    var $email1;
    var $email2;
    var $creacion;
    var $actualizacion;
    var $status;
    var $entrecalles;
    var $referencia;

    function insertar(){
        include_once("DBConnect.php");
        $respuesta = 0;
        $conn = null;
        $conn = new DBConnect(); // se construye el objeto
        $conexion = $conn->connect(); //el objeto invoca mediante una flecha -> a la funcion connect escrita en DBConnect
        $stmt = null;
        $query ="insert into fiscales ( id_cliente, creacion) values ( $this->id_cliente, NOW());";
        $stmt =  $conexion->prepare($query);
        $respuesta = $stmt->execute();
        return $respuesta;

    }

}