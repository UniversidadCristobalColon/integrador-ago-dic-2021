<?php
require '../../../config/db.php';

$idEnv = $_POST['id'];
if (saveFact($idEnv)) {
    header('location: ../index.php');
}else{
    echo saveFact($idEnv);
}

function saveFact($idEnv)
{
    $temp = $_FILES['fact']['tmp_name'];
    $size = $_FILES['fact']['size'];
    $type = $_FILES['fact']['type'];

    if ($type == 'application/pdf' || $type == 'text/xml') {
        if ($size <= (5 * 1024 * 1024)) { //5MB
            $nomFile = '';
            if ($type == 'application/pdf') {
                $nomFile = "factura_{$idEnv}.pdf";
            }
            if ($type == 'text/xml') {
                $nomFile = "factura_{$idEnv}.xml";
            }
            $moveIt = move_uploaded_file($temp, '/factura/' . $nomFile);
            if ($moveIt) {
                return true;
            } else {
                return 'Error al guardar la factura';
            }
        } else {
            return 'El tamaño del archivo excede el límite (5MB)';
        }
    } else {
        return 'Tipo de archivo incorrecto, sólo archivos .pdf o .xml';
    }
}
