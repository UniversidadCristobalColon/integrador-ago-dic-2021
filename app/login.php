<?php
session_start();

/*Logica para autenticar al usuario al iniciar sesión*/
require'../config/db.php';

$email=$_POST['email'];
$pass=$_POST['pass'];

$sql= "select * 
    from usuarios 
    where user='$email'";

$resultado=mysqli_query($conexion,$sql);



if($resultado!=false){
    $encontrados = mysqli_num_rows($resultado);

    if($encontrados==1){

        $fila=mysqli_fetch_assoc($resultado);

        $pass_en_bd=$fila['password'];
        //Verifica las contraseñas
        //if(password_verify($pass,$pass_en_bd)){//
        if ($pass==$pass_en_bd){

            $id_usuario=$fila['id'];
            $id_cliente=$fila['id_cliente'];
            $email_en_bd=$fila['user'];
            $perfil_usuario=$fila['id_perfil'];

            $_SESSION['id_usuario']=$id_usuario;
            $_SESSION['id_cliente']=$id_cliente;
            $_SESSION['email_usuario']=$email_en_bd;
            $_SESSION['perfil_usuario']=$perfil_usuario;

            $sql= "select * 
            from clientes 
            where email='$email'";
            $resultado=mysqli_query($conexion,$sql);
            $encontrados = mysqli_num_rows($resultado);
            $fila=mysqli_fetch_assoc($resultado);
            $nombre_en_bd=$fila['nombre'];
            $apellidos_en_bd=$fila['apellidos'];

            $_SESSION['nombre_usuario']=$nombre_en_bd;
            $_SESSION['apellidos_usuario']=$apellidos_en_bd;



            //Actualiza el ultimo login hecho por el usuario y envia al usuario a main.php
            header("location: main.php");


            $sql= "UPDATE usuarios
            SET ultimo_login=NOW()
            where user='$email'";

            $resultado=mysqli_query($conexion,$sql);
            //
        }else{

            $_SESSION['login_error']=1;
            header('location: index.php');
        }

    }else{
        $_SESSION['login_error']=1;
        header('location: index.php');
    }
}


?>