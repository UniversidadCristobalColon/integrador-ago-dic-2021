<?php

require_once '../../../config/db.php';
require_once '../../../vendor/Excel/SimpleXLSXGen.php';


//$sql = "SELECT id_cotizacion, CONCAT(clientes.nombre, ' ', clientes.apellidos) nombre_cliente, tipo_servicio,
//       CASE asegurado WHEN 'S' THEN 'asegurado' WHEN 'N' THEN 'No asegurado' END as 'Asegurado',
//       CASE factura WHEN 'S' THEN 'Facturado' WHEN 'N' THEN 'no facturado' END as 'facturado',
//       CASE recoleccion WHEN 'S' THEN 'Con recolección' WHEN 'N' THEN 'Sin recolección' END as 'recolectado',
//       fecha_creacion, fecha_respuesta
//FROM `cotizaciones` left join clientes on id_cliente = clientes.id left join direcciones dir_rem on id_dir_rem = dir_rem.id left join direcciones dir_des on id_dir_dest = dir_des.id;";

$sql = "SELECT id_cotizacion, CONCAT(clientes.nombre, ' ', clientes.apellidos) AS nombre_cliente, 
CONCAT(remitente.calle, ' ', remitente.num_exterior, ' ', coloniasremitente.colonia, ' CP ', municipiosremitente.municipio, ' ', estadosremitente.estado ) AS remitente, 
CONCAT(destinatario.calle, ' ', destinatario.num_exterior, ' ', coloniasdestinatario.colonia, ' CP ', municipiosdestinatario.municipio, ' ', estadosdestinatario.estado ) AS destinatario,
tipo_servicio, 
CASE asegurado WHEN 'S' THEN 'asegurado' WHEN 'N' THEN 'No asegurado' END as 'Asegurado', 
CASE factura WHEN 'S' THEN 'Facturado' WHEN 'N' THEN 'no facturado' END as 'facturado', 
CASE recoleccion WHEN 'S' THEN 'Con recolección' WHEN 'N' THEN 'Sin recolección' END as 'recolectado', 
fecha_creacion, fecha_respuesta 
FROM `cotizaciones` 
LEFT JOIN clientes ON id_cliente = clientes.id 
LEFT JOIN direcciones AS remitente ON id_dir_rem = remitente.id
LEFT JOIN colonias AS coloniasremitente ON remitente.id_colonia = coloniasremitente.id
LEFT JOIN municipios AS municipiosremitente ON coloniasremitente.id_municipio = municipiosremitente.id
LEFT JOIN localidades AS localidadesremitente ON coloniasremitente.id_localidad = localidadesremitente.id
LEFT JOIN estados AS estadosremitente ON municipiosremitente.id_estado = estadosremitente.id
LEFT JOIN direcciones AS destinatario ON id_dir_dest = destinatario.id
LEFT JOIN colonias AS coloniasdestinatario ON destinatario.id_colonia = coloniasdestinatario.id
LEFT JOIN municipios AS municipiosdestinatario ON coloniasdestinatario.id_municipio = municipiosdestinatario.id
LEFT JOIN localidades AS localidadesdestinatario ON coloniasdestinatario.id_localidad = localidadesdestinatario.id
LEFT JOIN estados AS estadosdestinatario ON municipiosdestinatario.id_estado = estadosdestinatario.id;";

$resultado = mysqli_query($conexion, $sql);

$data = array();

$data[] = ['ID','CLIENTE', 'REMITENTE', 'DESTINATARIO', 'TIPO DE SERVICIO', 'SEGURO', 'FACTURA', 'RECOLECCIÓN', 'CREACIÓN', 'RESPUESTA'];


if( $resultado ){
    while($fila = mysqli_fetch_assoc($resultado)){
        $data[] = $fila;
    }
}




SimpleXLSXGen::fromArray( $data )->downloadAs('cotizaciones.xlsx');