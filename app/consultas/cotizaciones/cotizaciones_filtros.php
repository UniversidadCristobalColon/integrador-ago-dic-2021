<?php
error_reporting(0);
define('DB_HOST', 'lizbethrojas.me');
define('DB_USER', 'pakmail_user');
define('DB_PASS', 'kp3C-sd6WVvRZeBV');
define('DB_NAME', 'pakmail');

$conexion = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conexion === false) { //¿error?
    exit('Error en la conexión con la bd');
}
mysqli_set_charset($conexion, 'utf8');
//Variables de las consultas
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $where = "";
    $nombre = $_POST['xnombre'];
    $email = $_POST['xemail'];
    $limit = $_POST['xregistro'];
}

//funcion buscar
if (isset($_POST['buscar'])){
    if (empty($_POST['xemail'])){
        $where="where nombre like '".$nombre."%'";
    }else if (empty($_POST['xnombre'])){
        $where="where email='".$email."'";
    }else{
        $where="where nombre like '".$nombre."%' and email='".$email."'";
    }
}

$clientes = "SELECT * FROM clientes $where $limit";
$resemail = $conexion->query($clientes);
$resclientes = $conexion->query($clientes);
$mensaje = "";
if (mysqli_num_rows($resemail)==0){
    $mensaje = "<h1>No hay registros que coincidan con tu criterio de busqueda.</h1>";
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Filtro de busqueda</title>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


</head>

<body>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="text-right"></div>

            <h1>Filtro de busqueda</h1>


            <form method="post">
                <input type="text" placeholder="Nombre" name="xnombre"/>
                <select name="xemail">
                <option value="">Email: </option>
                    <?php
                    while ($registroemail = $resemail->fetch_array(MYSQLI_BOTH)){
                        echo '<option value = "'.$registroemail['email'].'">'.$registroemail['email'].'</option>';
                    }
                    ?>
                </select>

                <select name="xregistro">
                    <option value="">No. de Registros</option>
                    <option value="limit 5">5</option>
                    <option value="limit 25">25</option>
                    <option value="limit 100">100</option>
                </select>
                <button type="submit" name="buscar" class="btn btn-primary">Buscar</button>
                <button type="button" class="btn btn-primary">Exportar a Excel</button>
            </form>

                <table class="table mt-5">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Email</th>
                        <th>Celular</th>
                        <th>&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    while ($registroclientes = $resclientes->fetch_array(MYSQLI_BOTH)){
                        echo'<tr>',
                            '<td>'.$registroclientes['nombre'].'</td>'.
                            '<td>'.$registroclientes['apellidos'].'</td>'.
                            '<td>'.$registroclientes['email'].'</td>'.
                            '<td>'.$registroclientes['celular'].'</td>';
                    }?>
                    </tbody>
                </table>
            <?php
            echo $mensaje;
            ?>
        </div>
    </div>
</div>
</body>
</html>