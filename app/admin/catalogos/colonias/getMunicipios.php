<?php

require_once '../../../../config/global.php';

$municipios = [];
$id_estado = $_GET["id_estado"];

include '../../../../config/db.php';


if( isset($conexion) ) {
    $query = "select id, id_estado,municipio from `pakmail`.municipios where status = 'A' and id_estado = $id_estado order by municipio asc ";
    if ($result = mysqli_query($conexion, $query))
        while ($row = $result->fetch_assoc())
            array_push($municipios, $row);
}

echo json_encode($municipios);