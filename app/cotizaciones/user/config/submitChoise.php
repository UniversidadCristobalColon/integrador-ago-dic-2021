<?php
require '../../../../config/db.php';
require '../../../../config/global.php';

$id_cotizacion = $_POST['id_cotizacion'];
$idServicioElegido = $_POST['idServicioElegido'];
$id_cliente = $_POST['id_cliente'];

// print_r($idServicioElegido);

$sqlElegido = "UPDATE servicios_disponibles SET status='S' WHERE id_servicio_disponible=$idServicioElegido";
$resultadoElegido = mysqli_query($conexion, $sqlElegido);
if ($resultadoElegido == true) {
    $sqlCotizacion = "UPDATE cotizaciones SET status = '2', actualizacion = NOW() WHERE id_cotizacion = $id_cotizacion";
    $resultadoCotizacion = mysqli_query($conexion, $sqlCotizacion);
    if($resultadoCotizacion == true){
        notificacion(125, 1, ('El cliente contestó la cotización ' . $id_cotizacion));
        header('location: ../manage.php?id=' . $id_cotizacion);
    }else{
        echo mysqli_error($conexion);
    }
} else {
    echo mysqli_error($conexion);
}

?>