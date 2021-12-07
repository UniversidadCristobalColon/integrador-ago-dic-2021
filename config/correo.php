<?php

    $subject=$_POST['subject'];
    $email_destino=$_POST['email_destino'];
    $message=$_POST['message'];

//function enviarCorreo($email_destino, $subject, $message){
//        global $conexion;

        require_once 'db.php';

        require_once '../vendor/autoload.php';

        $sql = "select usuario, password from serviciocorreos";

        $resultado = mysqli_query($conexion, $sql);

        $datos = array();

        if ($resultado) {
            while ($fila = mysqli_fetch_assoc($resultado)) {
                $datos[] = $fila;
            }
        }

//        print_r($datos);

        $EMAIL = $datos[0]['usuario'];
        $PASS = $datos[0]['password'];

        define('EMAIL', $EMAIL);
        define('PASS', $PASS);

        // Create the Transport
        $transport = (new Swift_SmtpTransport('smtp.gmail.com', 587, 'tls'))
            ->setUsername(EMAIL)
            ->setPassword(PASS);

        // Create the Mailer using your created Transport
        $mailer = new Swift_Mailer($transport);

        // Create a message
        $message = (new Swift_Message($_POST['subject']))
            ->setFrom([EMAIL => 'Servicios Pakmail'])
            ->setTo([$_POST['email_destino']])
            ->setBody($_POST['message']);

        // Send the message
        if ($result = $mailer->send($message)) {
            echo "Correo Enviado!";
        } else {
            echo "Fallo en Envio!";
        }
        header('location:javascript://history.go(-1)');

//    }
?>