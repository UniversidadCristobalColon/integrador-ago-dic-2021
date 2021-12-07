<?php
require '../../../../config/db.php';

$id_cotizacion = $_POST['id_cotizacion'];
$guia = $_POST['guia'];

$sqlUpdate = "UPDATE cotizaciones SET guia='$guia', status='3', actualizacion = NOW() WHERE id_cotizacion='$id_cotizacion'";
$resultado = mysqli_query($conexion, $sqlUpdate);
if ($resultado == true) {
    nuevoEnvio($id_cotizacion);
    header('location: ../manage.php?id=' . $id_cotizacion);
} else {
    echo mysqli_error($conexion);
}


function nuevoEnvio($id_cotizacion)
{
    require '../../../../config/db.php';
    $sql = "SELECT * from cotizaciones where id_cotizacion=$id_cotizacion";
    $resultado = mysqli_query($conexion, $sql);
    $c = mysqli_fetch_assoc($resultado);

    $sql = "SELECT * from servicios_disponibles where id_cotizacion=$id_cotizacion and status='S'";
    $resultado = mysqli_query($conexion, $sql);
    $servicio = mysqli_fetch_assoc($resultado);

    $id_cliente = $c['id_cliente'];
    $guia = $c['guia'];
    $id_dir_rem = $c['id_dir_rem'];
    $id_dir_dest = $c['id_dir_dest'];
    $id_paqueteria = $servicio['id_paqueteria'];
    $tipo_servicio = $c['tipo_servicio'];
    $asegurado = $c['asegurado'];
    $recoleccion = $c['recoleccion'];
    $precio = $servicio['precio'];
    $tiempo_estimado = $servicio['tiempo_estimado'];
    $factura = $c['factura'];
    $peso_real = $c['peso_total_real'];
    $peso_vol = $c['peso_total_vol'];
    $peso_fact = $c['peso_a_facturar'];

    $sql = "INSERT INTO envios
        (cotizacion,cliente,guia,dir_origen,dir_destino,paqueteria,tipo_servicio,seguro,recoleccion,costo,tiempo_estimado,factura,creacion,peso_vol,peso_real,peso_fact)
        VALUES
        ($id_cotizacion,$id_cliente,'$guia',$id_dir_rem,$id_dir_dest,$id_paqueteria,'$tipo_servicio','$asegurado','$recoleccion',$precio,'$tiempo_estimado','$factura',NOW(),$peso_vol,$peso_real,$peso_fact)";
    $resultado = mysqli_query($conexion, $sql);
    $id_envio = mysqli_insert_id($conexion);

    $sql = "SELECT * from paquetecotizado where id_cotizacion=$id_cotizacion";
    $resultado = mysqli_query($conexion, $sql);
    if ($resultado) {
        echo "tu que traes";
    } else {
        echo mysqli_error($conexion);
    }

    while ($fila = mysqli_fetch_assoc($resultado)) {
        $p = $fila;
        print_r($p);
        $tipo = $p['tipo'];
        $peso = $p['peso'];
        $largo = $p['largo'];
        $ancho = $p['ancho'];
        $alto = $p['alto'];
        $embalaje = $p['embalaje'];
        $descripcion = $p['descripcion'];
        $peso_volum = $p['peso_volum'];
        $cantidad = $p['cantidad'];

        $sql = "INSERT INTO paquetes_enviados
            (envio,tipo,peso,largo,ancho,alto,embalaje,descripcion,peso_volum,cantidad,creacion)
            VALUES
            ($id_envio,'$tipo',$peso,$largo,$ancho,$alto,'$embalaje','$descripcion',$peso_volum,$cantidad,NOW())";
        $res = mysqli_query($conexion, $sql);
        if ($res) {
            echo "paquetes enviados";
        } else {
            echo mysqli_error($conexion);
        }
    }
}



?>