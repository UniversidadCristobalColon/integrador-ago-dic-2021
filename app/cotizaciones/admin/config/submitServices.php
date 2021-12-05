<?php

    $paqueteria_name = $_POST['paqueteria_name'];
    $tiempo_name = $_POST['tiempo_name'];
    $precio_name = $_POST['precio_name'];

    $servicios = array();

    for ($i=0; $i < count($paqueteria_name); $i++) { 
        for ($i=0; $i < count($tiempo_name); $i++) { 
            for ($i=0; $i < count($precio_name); $i++) { 
                $array = array();
                $array[] = $paqueteria_name[$i];
                $array[] = $tiempo_name[$i];
                $array[] = $precio_name[$i];
                array_push($servicios, $array);
            }
        }
    }

    

    print '<pre>';

    // var_dump($paqueteria_name);
    // var_dump($tiempo_name);
    // var_dump($precio_name);

    print_r($servicios);

    print '</pre>';



?>