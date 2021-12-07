<?php
session_start();
$email_destino=$_SESSION['email_destino'];
$_SESSION['error_pass']='';
$pass1=$_POST['pass1'];
$pass2=$_POST['pass2'];
/*echo $email_destino;
echo $pass2,$pass1;*/
require '../config/db.php';

if ($pass1!=$pass2){
    $_SESSION['error_pass']= "Las contraseñas no coinciden";
    $_SESSION['login_error']=1;
    header('location: cambiar_password.php');
}else{
    if (strlen($pass1)<=7){
        $_SESSION['error_pass']="La contraseña tiene que tener al menos 8 caracteres" ;
        $_SESSION['login_error']=1;
        header('location: cambiar_password.php');
    }else{
        if ((preg_match('/[A-Z]/', $pass1))){
            $pass_en_hash=password_hash($pass1,PASSWORD_DEFAULT);

            $sql= "update usuarios
            set  password='$pass_en_hash'
            where user='$email_destino'";

            $resultado=mysqli_query($conexion,$sql);
            echo '<script language="javascript">';
            echo 'alert("Contraseña actualizada correctamente")';
            echo '</script>';
            header("location: logout.php");
            echo '<script language="javascript">';
            echo 'alert(message successfully sent)';  //not showing an alert box.
            echo '</script>';
            exit;

        }else{
            $_SESSION['error_pass']= "La contraseña tiene que tener al menos una mayúscula";
            $_SESSION['login_error']=1;
            header('location: cambiar_password.php');
        }
    }
}










?>