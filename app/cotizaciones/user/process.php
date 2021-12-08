<?php
$status = session_status();

if($status == PHP_SESSION_NONE) {
    //echo "no hay sesion";
    session_start();
}


$idCliente = $_SESSION['id_cliente'];

/*echo "id cliente<br>";
echo $idCliente ."<br>";*/

//require_once '../../../config/global.php';
require_once '../../../config/db.php';
//echo "hola<br>";
$tipoServicio = $_POST['tipoServicio'];
$origen = $_POST['origen'];
$direcDestino = $_POST['direcDestino'];
//$paquete = $_POST['datosPaquetes'];
$paquetes = $_POST['paquete'];
$pesoRealTotal = $_POST['pesoRealTotal'];
$pesoTotalVol = $_POST['pesoTotalVol'];
$pesoAFacturar = $_POST['pesoAFacturar'];
/*echo "hola" . "<br>";
echo $pesoRealTotal . "<br>";
echo $pesoTotalVol . "<br>";
echo $pesoAFacturar . "<br>";*/

if(array_key_exists('asegurar', $_POST)) {
    //echo "asegurar si existe<br>";
    $asegurado = $_POST['asegurar'];
} else {
    //echo "asegurar no existe<br>";
    $asegurado ='N';
}

if(array_key_exists('factura', $_POST)) {
    //echo "factura si existe<br>";
    $factura = $_POST['factura'];
} else {
    //echo "factura no existe<br>";
    $factura ='N';
}

if(array_key_exists('direcOrigen', $_POST)) {
    //echo "direcOrigen si existe<br>";
    $direcOrigen = $_POST['direcOrigen'];
}

//$datosPaquete = explode(",", $paquete);


/*echo var_dump($tipoServicio);
echo "<br>";
echo "asegurado" . "<br>";
echo var_dump($asegurado);
echo "<br>";
echo "factura" . "<br>";
echo var_dump($factura);
echo "<br>";*/

/*if(is_null($asegurado)) {
    //echo "asegurado es nulo<br>";
    $asegurado = 'N';
}

if(is_null($factura)) {
    //echo "factura es nulo<br>";
    $factura = 'N';
}*/

/*echo "origen<br>";
echo var_dump($origen);
echo "<br>";*/

$recoleccion = 'N';

if($origen == 'S') {
    //echo "Origen sucursal<br>";

    //echo "justo antes de select direc origen<br>";

    //echo "id cliente: " . $idCliente . "<br>";
    //Original
    //$obtenerDirecOrigen = "SELECT id FROM direcciones WHERE id_cliente = $idCliente AND alias = 'sucursal';";
    $obtenerDirecOrigen = "SELECT id FROM direcciones WHERE id_cliente = $idCliente AND alias = 'Sucursal Pakmail';";
    $resultado = mysqli_query($conexion, $obtenerDirecOrigen);



    if($resultado) {

        $direcsOrigen = array();

        while($fila = mysqli_fetch_assoc($resultado)) {
            $direcsOrigen = $fila;
        }

        //var_dump($direcsOrigen);

        $direcOrigen = $direcsOrigen['id'];

        /*echo "<br>";
        echo "id dir origen: " . $direcOrigen;
        echo "<br>";
        echo "<br>";*/
    } else {
        echo mysqli_error($conexion);
    }

} else if($origen == 'R') {
    //echo "Origen recolección<br>";
    $recoleccion = 'S';
}

/*echo "recoleccion<br>";
var_dump($recoleccion);*/

/*echo var_dump($direcOrigen);
echo "<br>";
echo var_dump($direcDestino);
echo "<br>";
echo var_dump($paquetes);
echo "<br>";
//echo print_r($paqueteDatos);
echo "paquetes inicio";
echo "<br>";
echo $paquetes[0];
echo "<br>";
echo "<br>";
echo $paquetes[1];
echo "<br>";
echo "<br>";*/

/*foreach($paquetes as $paqueteIndice) {
    $paquete = explode(",", $paqueteIndice);

    foreach($paquete as $paqueteDatos) {
        /*
        0 = Tipo de producto
        1 = Embalaje
        2 = Peso
        3 = Largo
        4 = Ancho
        5 = Alto
        6 = Cantidad
        7 = descripción


        //echo "<br>" . $paqueteDatos . "<br><br>";

        $tipo = $paqueteDatos[0];
        $embalaje = $paqueteDatos[1];
        $peso = $paqueteDatos[2];
        $largo = $paqueteDatos[3];
        $ancho = $paqueteDatos[4];
        $alto = $paqueteDatos[5];
        $cantidad = $paqueteDatos[6];
        $descripcion = $paqueteDatos[7];
        $pesoVolumetrico = ($largo * $ancho * $alto)/5000;
    }
}*/

/*INSERTAR FILAS EN TABLA DE DIRECCIONES*/

//$insert = "INSERT INTO direcciones(id, id_cliente, calle, num_exterior, num_interior, entre_calles, referencia, cp, id_colonia, creacion, actualizacion, status) VALUES(null, 23, 'La laguna Avenida Palmas', '40', '', 'Juan Pablo y Robles', 'Empresa', '12489', 15, NOW(), null, 'A')";
//$resultado = mysqli_query($conexion, $insert);

/*if($resultado) {
    $id_direc = mysqli_insert_id( $conexion );
    echo $id_direc;
} else {
    echo mysqli_error($conexion);
}*/

//$select = "SELECT cp, calle, num_exterior, num_interior, entre_calles, referencia FROM `direcciones` WHERE id_cliente = 23; ";



$insertCotizacion = "INSERT INTO cotizaciones (id_cotizacion, id_cliente, id_dir_rem, id_dir_dest, tipo_servicio, asegurado, factura, recoleccion, peso_total_real, peso_total_vol, peso_a_facturar, fecha_creacion) VALUES (null, $idCliente, $direcOrigen, $direcDestino, '$tipoServicio', '$asegurado', '$factura', '$recoleccion', $pesoRealTotal, $pesoTotalVol, $pesoAFacturar, NOW())";
$resultado = mysqli_query($conexion, $insertCotizacion);

if($resultado) {

    $idCotizacion = mysqli_insert_id($conexion);

    /*echo "<br>";
    echo "id cotizacion: " . $idCotizacion;
    echo "<br>";
    echo "<br>";*/

    foreach($paquetes as $paqueteIndice) {
        /*echo "paqueteIndice<br>";
        echo $paqueteIndice;
        echo "<br>";
        echo "<br>";*/

        $paquete = explode(",", $paqueteIndice);

        /*echo "paquete<br>";
        echo var_dump($paquete);
        echo "<br>";
        echo "<br>";*/

        $tipo = $paquete[0];
        $embalaje = $paquete[1];
        $peso = $paquete[2];
        $largo = $paquete[3];
        $ancho = $paquete[4];
        $alto = $paquete[5];
        $cantidad = $paquete[6];
        $descripcion = $paquete[7];
        $pesoVolumetrico = ($largo * $ancho * $alto) / 5000;
        //echo $pesoVolumetrico;

        /*echo "tipo:" . $tipo;
        echo "<br>";
        echo "embalaje:" . $embalaje;
        echo "<br>";
        echo "peso:" . $peso;
        echo "<br>";
        echo "largo:" . $largo;
        echo "<br>";
        echo "ancho:" . $ancho;
        echo "<br>";
        echo "alto:" . $alto;
        echo "<br>";
        echo "cantidad:" . $cantidad;
        echo "<br>";
        echo "descripcion:" . $descripcion;
        echo "<br>";*/


        //$insertPaquete = "INSERT INTO paquetecotizado (id_paquete, id_cotizacion, tipo, peso, largo, ancho, alto, embalaje, descripcion ,peso_volum, cantidad, creacion) VALUES (null, $idCotizacion, '$tipo', $peso, $largo, $ancho, $alto, '$embalaje', 'zapatos' , 36, $cantidad ,NOW())";
        $insertarPaquete = "INSERT INTO paquetecotizado (id_paquete, id_cotizacion, tipo, peso, largo, ancho, alto, embalaje, descripcion ,peso_volum, cantidad, creacion) VALUES (null, $idCotizacion, '$tipo', $peso, $largo, $ancho, $alto, '$embalaje', '$descripcion' , $pesoVolumetrico, $cantidad ,NOW())";
        $resultado = mysqli_query($conexion, $insertarPaquete);

        if($resultado) {
            $idPaqueteCot = mysqli_insert_id($conexion);

            /*echo "<br>";
            echo "id paquete cotizado" . $idPaqueteCot;
            echo "<br>";
            echo "<br>";*/
        } else {
            echo mysqli_error($conexion);
        }

    }

    header('location: index.php');

} else {
    echo mysqli_error($conexion);
}

?>