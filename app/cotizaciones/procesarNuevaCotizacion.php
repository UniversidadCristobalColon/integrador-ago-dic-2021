<?php
require_once '../../config/db.php';
//require_once '../../config/global.php';
//echo "hola<br>";
$tipoServicio = $_POST['tipoServicio'];
$asegurado = $_POST['asegurar'];
$factura = $_POST['factura'];
$origen = $_POST['origen'];
$direcOrigen = $_POST['direcOrigen'];
$direcDestino = $_POST['direcDestino'];
$paquete = $_POST['datosPaquetes'];

$paqueteDatos = explode(",", $paquete);

echo var_dump($tipoServicio);
echo "<br>";
echo var_dump($asegurado);
echo "<br>";
echo var_dump($factura);
echo "<br>";
echo var_dump($origen);
echo "<br>";
echo var_dump($direcOrigen);
echo "<br>";
echo var_dump($direcDestino);
echo "<br>";
echo var_dump($paquete);
echo "<br>";
echo print_r($paqueteDatos);
echo "<br>";

$tipo = $paqueteDatos[0];
$embalaje = $paqueteDatos[1];
$peso = $paqueteDatos[2];
$largo = $paqueteDatos[3];
$ancho = $paqueteDatos[4];
$alto = $paqueteDatos[5];
$cantidad = $paqueteDatos[6];


//$insert = "INSERT INTO direcciones(id, id_cliente, calle, num_exterior, num_interior, entre_calles, referencia, cp, id_colonia, creacion, actualizacion, status) VALUES(null, 23, 'La laguna Avenida Palmas', '40', '', 'Juan Pablo y Robles', 'Empresa', '12489', 15, NOW(), null, 'A')";
//$resultado = mysqli_query($conexion, $insert);

/*if($resultado) {
    $id_direc = mysqli_insert_id( $conexion );
    echo $id_direc;
} else {
    echo mysqli_error($conexion);
}*/

//$select = "SELECT cp, calle, num_exterior, num_interior, entre_calles, referencia FROM `direcciones` WHERE id_cliente = 23; ";
$insertCotizacion = "INSERT INTO cotizaciones (id_cotizacion, id_cliente, id_dir_rem, id_dir_dest, tipo_servicio, asegurado, factura, recoleccion, fecha_creacion) VALUES (null, 23, $direcOrigen, $direcDestino, '$tipoServicio', '$asegurado', '$factura', 'N', NOW())";
$resultado = mysqli_query($conexion, $insertCotizacion);

if($resultado) {

    $idCotizacion = mysqli_insert_id($conexion);

    echo "<br>";
    echo $idCotizacion;
    echo "<br>";
    echo "<br>";

    $insertPaquete = "INSERT INTO paquetecotizado (id_paquete, id_cotizacion, tipo, peso, largo, ancho, alto, embalaje, descripcion ,peso_volum, cantidad, creacion) VALUES (null, $idCotizacion, '$tipo', $peso, $largo, $ancho, $alto, '$embalaje', 'zapatos' , 36, $cantidad ,NOW())";
    $resultado = mysqli_query($conexion, $insertPaquete);

    if($resultado) {
        $idPaqueteCot = mysqli_insert_id($conexion);

        echo "<br>";
        echo $idPaqueteCot;
        echo "<br>";
        echo "<br>";
    } else {
        echo mysqli_error($conexion);
    }

    /*while( $fila = mysqli_fetch_assoc($resultado)) {
        $direcciones[] = $fila;
    }

    $contador = 0;

    echo "<br>";

    foreach($direcciones as $d) {

        echo "Direccion: {$contador}<br>";

        $cp = $d['cp'];
        $calle = $d['calle'];
        $numExt = $d['num_exterior'];
        //$numInt = $d['num_int'];
        $entreCalles = $d['entre_calles'];
        $referencia = $d['referencia'];
        echo "{$d['cp']}<br>";
        echo "CP: {$cp}<br>";
        echo "Calle: {$calle}<br>";
        echo "Num ext: {$numExt}<br>";
        echo "Entre calles: {$entreCalles}<br>";
        echo "Referencia: {$referencia}<br>";
        echo "<br>";

        $direccion = $calle . " numero " . $numExt . " entre las calles " . $entreCalles . ", referencia: " . $referencia; //agregar colonia al principio
        echo "<br>{$direccion}<br><br>";
        $contador++;
    }*/

} else {
    echo mysqli_error($conexion);
}

?>