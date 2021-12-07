<?php
require '../../../../config/db.php';

    $id_cotizacion = $_POST['id_cotizacion'];
    $paqueteria_id = $_POST['paqueteria_id'];
    $tiempo_name = $_POST['tiempo_name'];
    $precio_name = $_POST['precio_name'];

    $servicios = array();

    // Manipulación de datos (servicios enviados) a un nuevo array ordenado
    for ($i=0; $i < count($paqueteria_id); $i++) { 
        for ($i=0; $i < count($tiempo_name); $i++) { 
            for ($i=0; $i < count($precio_name); $i++) { 
                $array = array();
                $array[] = $paqueteria_id[$i];
                $array[] = $tiempo_name[$i];
                $array[] = $precio_name[$i];
                array_push($servicios, $array);
            }
        }
    }

    foreach ($servicios as $one) {
        $sqlInsert = "INSERT INTO servicios_disponibles (id_cotizacion, id_paqueteria, tiempo_estimado, precio, creacion, actualizacion, status) VALUES ($id_cotizacion, $one[0], '$one[1]', $one[2], NOW(), NOW(), 'N')";
        $resultadoInsert = mysqli_query($conexion, $sqlInsert);
        if ($resultadoInsert == true) {
            $sqlUpdate = "UPDATE cotizaciones SET status = '1', fecha_respuesta = NOW(), actualizacion = NOW() WHERE id_cotizacion = $id_cotizacion";
            $resultadoUpdate = mysqli_query($conexion, $sqlUpdate);
        } else {
            echo mysqli_error($conexion);
        }
    }
    if ($resultadoUpdate == true) {
        header('location: ../manage.php?id=' . $id_cotizacion);
    }else{
        echo mysqli_error($conexion);
    }

?>