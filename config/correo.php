<?php
require 'db.php';

function envioCorreos($ruta= ''){

$sql1= "select usuario from serviciocorreos";
$sql2= "select password from serviciocorreos";

$EMAIL=mysqli_query($conexion,$sql1);
$PASS=mysqli_query($conexion,$sql2);

if(isset($_POST['sendmail'])) {
    require_once '../../../../vendor/autoload.php';


    // Create the Transport
    $transport = (new Swift_SmtpTransport('smtp.gmail.com', 587, 'tls'))
        ->setUsername(EMAIL)
        ->setPassword(PASS);

    // Create the Mailer using your created Transport
    $mailer = new Swift_Mailer($transport);

    // Create a message
    $message = (new Swift_Message($_POST[$subject]))
        ->setFrom([EMAIL => 'Servicios Pakmail'])
        ->setTo([$_POST[$destino]])
        ->setBody($_POST[$message]);

    if ($mailer->send($message)) {
        return true;
    }
}
}
?>

