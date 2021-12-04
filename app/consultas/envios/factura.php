<?php
require '../../../config/db.php';

$idEnv = $_POST['id'];
$temp = $_FILES['factura']['tmp_name'];
$type = $_FILES['factura']['type'];

if ($type == 'application/pdf' || $type == 'text/xml') {
    $nomFile = '';
    if ($type == 'application/pdf') {
        $nomFile = "factura_{$idEnv}.pdf";
    }
    if ($type == 'text/xml') {
        $nomFile = "factura_{$idEnv}.xml";
    }
    $moveIt = move_uploaded_file($temp, '/factura/' . $nomFile);
    if ($moveIt) {
        header('location: index.php');
    } else {
        return 'Error al guardar la factura';
    }
} else {
    return 'Tipo de archivo incorrecto, sólo archivos .pdf o .xml';
}
