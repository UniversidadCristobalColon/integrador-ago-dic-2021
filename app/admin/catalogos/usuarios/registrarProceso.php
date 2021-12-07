<?php

session_start();

include '../../../../config/db.php';

if( isset($_POST) && count($_POST)>0 && isset($conexion) ) {

    $usuario = $_POST["correo"];
    $passowrd = password_hash($_POST["password"], PASSWORD_DEFAULT); //password hash
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $correo = $_POST["correo"];
    $celular = $_POST["celular"];
    $telefono = $_POST["telefono"];

    $query = "INSERT INTO `pakmail`.clientes (nombre, apellidos, email, celular, telefono) VALUES ('$nombre','$apellidos','$correo','$celular','$telefono')";

    if( $insert = mysqli_query($conexion,$query) ){
        $id_insert =  mysqli_insert_id($conexion);

        //$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        //$codigo_activacion = substr(str_shuffle($permitted_chars), 0, 30);

        $tipo = $_POST["tipo"];
        $query = "INSERT INTO `pakmail`.usuarios (user, password, id_perfil) VALUES ('$usuario','$passowrd','$tipo') ";

        if( $insert = mysqli_query($conexion,$query) ){

                /*require '../../../../phpmailer/src/PHPMailer.php';
                require '../../../../phpmailer/src/Exception.php';
                require '../../../../phpmailer/src/OAuth.php';
                require '../../../../phpmailer/src/SMTP.php';

                //use PHPMailer\PHPMailer\PHPMailer;

                $mail = new PHPMailer(true);
                $mail->IsSMTP();

                $mail->From = "mail@gmail.com"; //remitente
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = 'tls'; //seguridad
                $mail->Host = "smtp.gmail.com"; // servidor smtp
                $mail->Port = 587; //puerto
                $mail->Username ='pakmaildev@gmail.com'; //nombre usuario
                $mail->Password = 'pakmaildevpass';
                $mail->setFrom('pakmaildev@gmail.com','Pakmail');

                $mail->addAddress( $_POST["correo"] );

                $mail->Subject= "Verificación de usuario";
                $mail->Body = "
                    <h1>Hola, $nombre</h1>
                    <p>Para acceder a tu nueva cuenta de Pakmail es necesario que actives tu cuenta</p>
                    <a href='http://localhost/integrador/app/activacion.php?activacion=$codigo_activacion'>Activar cuenta ahora</a>
                ";

                $mail->header = 'Content-type: text/html; charset=iso-8859-1' . "rn";
                $mail->isHTML(true);
                $mail->CharSet = 'UTF-8';
                $send = $mail->send();

                var_dump($send);*/

                $_SESSION["exito_registro_usuario_pakmail"] = "Usuario registrado exitosamente, se envió un correo de verificación al usuario";
                header('location: registrar.php');

        }else{
            $_SESSION["error_registro_usuario_pakmail"] = "Error en el proceso, inténtelo más tarde";
            header('location: registrar.php');
        }

    }else{
        $_SESSION["error_registro_usuario_pakmail"] = "Usuario no disponible";
        header('location: registrar.php');
    }

}