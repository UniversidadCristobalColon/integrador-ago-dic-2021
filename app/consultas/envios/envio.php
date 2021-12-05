<?php
require '../../../config/db.php';

function nuevoEnvio($id_cotizacion)
{
    $sql = "SELECT * from cotizaciones where id_cotizacion=$id_cotizacion";
    $resultado = mysqli_query($conexion, $sql);

    $c = mysqli_fetch_assoc($resultado);
    $sql = "SELECT * from servicios_disponibles where id_cotizacion=$id_cotizacion and status=S";
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

    $sql = "INSERT INTO envios
        (cotizacion,cliente,guia,dir_origen,dir_destino,paqueteria,tipo_servicio,seguro,recoleccion,costo,tiempo_estimado,factura)
        VALUES
        ($id_cotizacion,$id_cliente,'$guia',$id_dir_rem,$id_dir_dest,$id_paqueteria,'$tipo_servicio','$asegurado','$recoleccion',$precio,$tiempo_estimado,'$factura')";
    mysqli_query($conexion, $sql);

    $sql = "SELECT * from paquetecotizado where id_cotizacion=$id_cotizacion";
    $resultado = mysqli_query($conexion, $sql);
    $paqueteCot = array();
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $paqueteCot = $fila;
    }

    foreach ($paqueteCot as $p) {
        $id_envio = mysqli_insert_id($conexion);
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
            (envio,tipo,peso,largo,ancho,alto,embalaje,descripcion,peso_volum,cantidad)
            VALUES
            ($id_envio,$tipo,$peso,$largo,$ancho,$alto,'$embalaje','$descripcion',$peso_volum,$cantidad)";
        mysqli_query($conexion, $sql);
    }
}