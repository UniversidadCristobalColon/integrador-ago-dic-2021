<?php

require_once '../../../config/db.php';
require_once '../../../vendor/Excel/SimpleXLSXGen.php';


$sql = "SELECT envios.id, cotizacion, CONCAT(clientes.nombre, ' ', clientes.apellidos) AS cliente, guia, seguimiento, 
CONCAT(remitente.calle, ' ', remitente.num_exterior, ' ', coloniasremitente.colonia, ' CP ', municipiosremitente.municipio, ' ', estadosremitente.estado ) AS remitente,
CONCAT(destinatario.calle, ' ', destinatario.num_exterior, ' ', coloniasdestinatario.colonia, ' CP ', municipiosdestinatario.municipio, ' ', estadosdestinatario.estado ) AS destinatario, 
paqueterias.paqueteria, tipo_servicio, CASE seguro WHEN 'S' THEN 'Asegurado' WHEN 'N' THEN 'No asegurado' END as 'Asegurado',
CASE recoleccion WHEN 'S' THEN 'Con recolección' WHEN 'N' THEN 'Sin recolección' END as 'recolectado',
costo, tiempo_estimado, CASE factura WHEN 'S' THEN 'Facturado' WHEN 'N' THEN 'no facturado' END as 'facturado', envios.creacion
FROM `envios`
left join clientes  on cliente = clientes.id
left join paqueterias on envios.paqueteria = paqueterias.id
LEFT JOIN direcciones AS remitente ON dir_origen = remitente.id
LEFT JOIN colonias AS coloniasremitente ON remitente.id_colonia = coloniasremitente.id
LEFT JOIN municipios AS municipiosremitente ON coloniasremitente.id_municipio = municipiosremitente.id
LEFT JOIN localidades AS localidadesremitente ON coloniasremitente.id_localidad = localidadesremitente.id
LEFT JOIN estados AS estadosremitente ON municipiosremitente.id_estado = estadosremitente.id
LEFT JOIN direcciones AS destinatario ON dir_destino = destinatario.id
LEFT JOIN colonias AS coloniasdestinatario ON destinatario.id_colonia = coloniasdestinatario.id
LEFT JOIN municipios AS municipiosdestinatario ON coloniasdestinatario.id_municipio = municipiosdestinatario.id
LEFT JOIN localidades AS localidadesdestinatario ON coloniasdestinatario.id_localidad = localidadesdestinatario.id
LEFT JOIN estados AS estadosdestinatario ON municipiosdestinatario.id_estado = estadosdestinatario.id;";

$resultado = mysqli_query($conexion, $sql);

$data = array();

$data[] = ['ID', 'COTIZACION', 'CLIENTE', 'GUIA', 'SEGUIMIENTO', 'ORIGEN', 'DESTINO',
    'PAQUETERIA', 'TIPO DE SERVICIO', 'SEGURO', 'RECOLECCIÓN', 'COSTO', 'TIEMPO ESTIMADO',
    'FACTURA', 'CREACIÓN'
];

if( $resultado ){
    while($fila = mysqli_fetch_assoc($resultado)){
        $data[] = $fila;
    }
}




SimpleXLSXGen::fromArray( $data )->downloadAs('envios.xlsx');