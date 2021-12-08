<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Packmail</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin.css" rel="stylesheet">
    <link href="../img/favicon.jpg" rel="shortcut icon" type="image/png"/>


</head>

<body class="bg-dark">

<div class="container">
    <div class="card card-login mx-auto mt-5">
        <div class="card-header">Pakmail</div>
        <div class="card-body">
            <div class="text-center mb-4">
                <h4>Registro</h4>
                <p>Cree una cuenta y empiece a cotizar sus envíos.</p>
            </div>
            <form method="post" action="models/guardar-cliente.php">
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="text" id="nombre"  name="txtNombre" class="form-control" placeholder="Nombre(s)" required="required" autofocus="autofocus">
                        <label for="nombre">Nombre(s)</label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-label-group">
                        <input type="text" id="apellido" name="txtApps" class="form-control" placeholder="Apellido(s)" required="required">
                        <label for="apellido">Apellido(s)</label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-label-group">
                        <input type="email" id="email"  name="txtEmail" class="form-control" placeholder="Correo electrónico" required="required">
                        <label for="email">Correo electrónico</label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-label-group">
                        <input type="password" id="password" name="txtPwd" class="form-control" placeholder="Contraseña" required="required">
                        <label for="password">Contraseña</label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-label-group">
                        <input type="password" id="confirmacion"  class="form-control" placeholder="Confirme su contraseña" required="required">
                        <label for="confirmacion">Confirme su contraseña</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Registrarse</button>
            </form>
            <div class="text-center">
                <a class="d-block small mt-3" href="index.php">Página de inicio</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="../vendor/jquery-easing/jquery.easing.min.js"></script>


</body>

</html>

*