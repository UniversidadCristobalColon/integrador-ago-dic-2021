<?php
header('Content-type: application/json');
require_once '../../config/db.php';

$metodo = $_POST['metodo'];

switch($metodo){
    case 'cp':
        $cp = $_POST['cp'];
        getCP($cp, $conexion);
        break;
    case 'saveedit':
        saveEditDirection($_POST, $conexion);
    break;
    case 'muestradireccion':
        $id = $_POST['id'];
        showDirection($id, $conexion);
        break;
    case 'eliminadireccion':
        $id = $_POST['id'];
        deleteDirection($id, $conexion);
        break;
}

function getCP($num_cp, $connection)
{
    $sql = "SELECT c.id as id, c.colonia, l.id id_localidad, l.localidad, m.id id_municipio, m.municipio, e.id id_estado, e.estado FROM `colonias` c 
    left join localidades l on c.id_localidad = l.id 
    left join municipios m on c.id_municipio = m.id 
    left join estados e on m.id_estado = e.id where cp = $num_cp;";

    $response = array();

    $resultado = mysqli_query($connection, $sql);

    if ($resultado) {
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $response[] = $fila;
        }
    }

//    echo $sql;

//    $sqlcolonias = "SELECT* FROM colonias where cp = $num_cp";
//
//    $resultado = mysqli_query($connection, $sqlcolonias);
//
//    if ($resultado) {
//        while ($fila = mysqli_fetch_assoc($resultado)) {
//            $colonias[] = $fila;
//        }
//    }

    echo json_encode($response);


}

function saveEditDirection($direction, $connection){

    if(!array_key_exists('id', $direction)){

    $sql = "INSERT INTO `direcciones` (`id`, `id_cliente`, `alias`, `calle`, `num_exterior`, `num_interior`, `entre_calles`, `referencia`, `cp`, `id_colonia`, `creacion`, `actualizacion`, `status`) 
    VALUES
    (null, '".$direction['cliente']."', '".$direction['alias']."', '".$direction['calle']."', '".$direction['numext']."', '".$direction['numint']."', '".$direction['entrecalles']."', '".$direction['referencia']."', '".$direction['cp']."', '".$direction['colonia']."', 'NOW()', 'NOW()', 'A');";


    $resultado = mysqli_query($connection, $sql);

    if ($resultado) {
        echo json_encode('Direccion creada con exito');
        }
    else echo json_encode('Ha ocurrido un error');

    } else {

        $sql = "
        UPDATE `direcciones`
        set 
        alias = '".$direction['alias']."',
        calle = '".$direction['calle']."',
        num_exterior = '".$direction['numext']."',
        num_interior = '".$direction['numint']."',
        entre_calles = '".$direction['entrecalles']."',
        referencia = '".$direction['referencia']."',
        id_colonia = '".$direction['colonia']."',
        cp = '".$direction['cp']."',
        actualizacion = now()
        where id = ".$direction['id']."
        ";

        $resultado = mysqli_query($connection, $sql) or trigger_error(mysqli_error($connection));

        if ($resultado) {
            echo json_encode('Direccion actualizada con exito');
        }
        else echo json_encode('Ha ocurrido un error');

    }
//    echo ($sql);
}

function showDirection($id, $connection){
    $sql = "SELECT * FROM direcciones where id = $id";

    $response = array();

    $resultado = mysqli_query($connection, $sql);

    if ($resultado) {
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $response[] = $fila;
        }
    }

    echo json_encode($response);
}

function deleteDirection($id, $connection){

    $sql = "update direcciones set status = 'B' where id = $id";

    $resultado = mysqli_query($connection, $sql);

    if ($resultado) {
        echo json_encode("Direccion eliminada correctamente");
    } else {
        echo json_encode("Ocurrió un error");
    }

}

$conexion->close();





