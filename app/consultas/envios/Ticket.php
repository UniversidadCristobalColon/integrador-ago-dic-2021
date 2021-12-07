<?php

require '../../../vendor/SPDF/tcpdf.php';
require '../../../config/db.php';

//$id_envio = 18;
$id_envio = $_POST['id_envio'];

$sql = "SELECT CONCAT(clientes.nombre, ' ', clientes.apellidos) as cliente, DATE_FORMAT(envios.creacion,'%e/%c/%Y') as fecha,
DATE_FORMAT(envios.creacion,'%H:%i') as hora, guia, 
CONCAT(dir_des.calle, ' ', cd.colonia, ' ', md.municipio, ' ', ed.estado, ' CP ', cd.cp ) as destino,
peso_real, tipo_servicio, CASE seguro WHEN 'S' THEN 'Asegurado' WHEN 'N' THEN 'No asegurado' END as 'asegurado', 
tiempo_estimado, costo
from clientes
left join envios on envios.cliente = clientes.id
left join direcciones dir_des on envios.dir_origen = dir_des.id
left join `colonias` cd on dir_des.id_colonia = cd.id
left join localidades ld on cd.id_localidad = ld.id 
left join municipios md on cd.id_municipio = md.id 
left join estados ed on md.id_estado = ed.id
where envios.id = $id_envio;";

$resultado = mysqli_query($conexion, $sql);

$envio = array();

if( $resultado ){
    while($fila = mysqli_fetch_assoc($resultado)){
        $envio[] = $fila;
    }
}

$sql2 = "select* from paquetes_enviados where envio = $id_envio";

$resultado2 = mysqli_query($conexion, $sql2);

$paquetes = array();

if( $resultado2 ){
    while($fila = mysqli_fetch_assoc($resultado2)){
        $paquetes[] = $fila;
    }
}

//print_r($paquetes);


$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('PAKMAIL');
$pdf->SetTitle('Ticket de venta');

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

$pdf->AddPage();

$html = '
<head>
</head>
<style>
table {

    border-collapse: collapse;
}

table.info {

    border-collapse: collapse;
    width: 630px
}
th.product {
    background-color:  #9c042c;
    color: #e2e6ea;
    border-collapse: collapse;
}

.centrado {
    display:block;
    text-align: center;
    align-content: center;
}

th.titulo{
    background-color:  #9c042c;
    color: #e2e6ea;
    border-collapse: collapse;
}

tfoot{
    text-align: right;
}

img {

    margin-left: auto;
    margin-right: auto;
}
</style>

 <div style="text-align:center">
    <img width="500px" src="https://enviaya-public.s3.us-west-1.amazonaws.com/white_labels/white_label_1395/logo.png" alt="Logotipo">
   <h1 class="centrado">Ticket de venta</h1>
    <p>
    Pakmail S.A. de C.V.
                <br>Calle España 422 1, poligono 1
                <br>Reforma, Veracruz, Ver.     C.P.91700
                <br>R.F.C. PAK2012GLUVER
    </p>
    </div>
    <div>   
    <table>
        <tbody>
        <tr>
            <td>Sucursal: Xalapa, entre Morelos y Pavón, 17091, Veracruz, Ver.
            </td>
        </tr>
               <tr>
            <td>Cliente: ' .$envio[0]['cliente'].'</td>
        </tr>
        <tr>
            <td>Fecha: '.$envio[0]['fecha'].'</td>
        </tr>
        <tr>
            <td>Hora: '.$envio[0]['hora'].'</td>
        </tr>
                </tbody>
    </table>
    <table class="info">
        <thead>
        <tr>
            <th colspan="3" class="titulo">INFORMACIÓN</th>
            
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Guía: '.$envio[0]['guia'].'</td>
            <td></td>
        </tr>
        <tr>
            <td style = "width: 100%">Dirección destino: '.$envio[0]['destino'].'</td>
            <td></td>
        </tr>
        <tr>
            <td>Peso:        '.$envio[0]['peso_real'].'</td>
            <td> </td>
        </tr>
        <tr>
            <td>Tipo de servicio: '.$envio[0]['tipo_servicio'].'</td>
            <td> </td>
        </tr>
        <tr>
            <td>Seguro: '.$envio[0]['asegurado'].'</td>
            <td> </td>
        </tr>
        <tr>
            <td>Tiempo estimado: '.$envio[0]['tiempo_estimado'].'</td>
            <td> </td>
        </tr>
        </tbody>
    </table>
    <table>
        <thead>
        <tr>
            <th class="product">CANT</th>
            <th class="product">DESCRIPCIÓN</th>
            <th class="product">PESO VOLUMETRICO</th>
        </tr>
        </thead>
        <tbody>
        ';


foreach ($paquetes as $p){
    $html .= '
        <tr>
            <td>'.$p['cantidad'].'</td>
            <td>'.$p['descripcion'].'</td>
            <td>'.$p['peso_volum'].'</td>
        </tr>
    ';
}

$html .= '
        
           </tbody>
        <tfoot >
    <tr >
      <td colspan="2" style="text-align: right">Total: </td>
      <td >$'.$envio[0]['costo'].'</td>
    </tr>
  </tfoot>
    </table>

    <p style="text-align: center">    ¡GRACIAS POR SU COMPRA!   </p>
</div>
</body>
</html> 
';

//echo $html;

$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output('Ticket_de_venta.pdf', 'I');

