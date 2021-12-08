<?php
include '../../../../config/db.php';

$idEstado = isset($_POST['idEstado']) ? $_POST['idEstado'] : null;

$estados = [];

$query = "SELECT m.id, m.municipio, m.id_estado, m.creacion, m.actualizacion, m.status 
                                    FROM `pakmail`.municipios m
                                    WHERE id_estado = $idEstado ORDER BY m.municipio ASC";

if ($result = mysqli_query($conexion, $query)) {
        while ($row = $result->fetch_assoc()) {
                array_push($estados, $row["municipio"]);
        }
}

$json_string = json_encode($estados, JSON_PRETTY_PRINT);
header('Content-Type: application/json'); 

echo $json_string;