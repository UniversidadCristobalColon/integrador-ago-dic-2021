<?php
include_once("../models/clientes.php");
include_once("../models/usuarios.php");
$cli=new clientes();
$usu= new usuarios();
$cli->nombre = $_POST['txtNombre'];
$cli->apellidos= $_POST['txtApps'];
$cli->email= $_POST['txtEmail'];
$ra=$cli->guardar();
$usu->user=$_POST['txtEmail'];
$usu->password=$_POST["txtPwd"];
$usu->id_perfil=$ra;
$rA=$usu->guardar();
if($rA>0){



	$conexion = mysqli_connect('lizbethrojas.me', 'pakmail_user', 'kp3C-sd6WVvRZeBV', 'pakmail');

	if ($conexion === false) { //¿error?
		exit('Error en la conexión con la bd');
	}
	mysqli_set_charset($conexion, 'utf8');

		$sql1= "select usuario from serviciocorreos";
		$sql2= "select password from serviciocorreos";

		$EMAIL=mysqli_query($conexion,$sql1);
		$PASS=mysqli_query($conexion,$sql2);
		$arrayEmail = mysqli_fetch_assoc($EMAIL);
		$arrayPass = mysqli_fetch_assoc($PASS);


			require_once '../../vendor/autoload.php';


			// Create the Transport
			$transport = (new Swift_SmtpTransport('smtp.gmail.com', 587, 'tls'))
				->setUsername($arrayEmail["usuario"])
				->setPassword($arrayPass["password"]);

			// Create the Mailer using your created Transport
			$mailer = new Swift_Mailer($transport);

			// Create a messageverificac
			$message = (new Swift_Message('Verificación del correo'))
				->setFrom([$arrayEmail["usuario"] => 'Servicios Pakmail'])
				->setTo([$_POST['txtEmail']])
				->setBody('<html><body>Para continuar con el <strong>registro</strong> en Pakmail es necesario su confirmación en la siguiente liga <a href="https://localhost/integrador-ago-dic-2021/app/confirmacion.php?id='.$ra.'">Click aqui para verificar</a></body></html>', 'text/html')

	->addPart(' <html><body>Para continuar con el <strong>registro</strong> en Pakmail es necesario su confirmación en la siguiente liga <a href="https://localhost/integrador-ago-dic-2021/app/confirmacion.php?id='.$ra.'">Click aqui para verificar</a></body></html>' , 'text/html');
 			$mailer->send($message);




	header("Location: ../success.php?v=1");
}else{
	if($rA>0){
	header("Location: ../success.php?v=2");
}
}

?>


*
