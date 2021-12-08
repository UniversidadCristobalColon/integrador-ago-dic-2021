<?php

function get_sucursales(): array{

    $sucursales = [];
    include '../../../../config/db.php';

    if( isset($conexion) ) {
        $query =    "SELECT s.id,s.sucursal, s.domicilio, c.cp, c.colonia, m.municipio, e.estado, s.creacion, s.actualizacion, s.status, l.localidad
                    FROM sucursales s 
                    LEFT JOIN colonias c on s.id_colonia = c.id 
                    LEFT JOIN localidades l on s.id_localidad = l.id    
                    left join municipios m on m.id = c.id_municipio 
                    left join estados e on e.id = m.id_estado order by s.id desc;";
        if ($result = mysqli_query($conexion, $query))
            while ($row = $result->fetch_assoc())
                array_push($sucursales, $row);
    }
    return $sucursales;
}

function get_sucursal($id): array{
    $sucursal = [];
    include '../../../../config/db.php';

    if( isset($conexion) ) {
        $query = "SELECT s.id,s.sucursal, s.domicilio, c.cp, c.colonia, c.id as id_colonia, l.localidad, l.id 
                    as id_localidad, m.municipio, m.id 
                    as id_municipio, e.estado, e.id 
                    as id_estado, s.creacion, s.actualizacion, s.status 
                    FROM sucursales s 
                    LEFT JOIN colonias c on s.id_colonia = c.id 
                    LEFT JOIN localidades l on l.id = s.id_localidad 
                    LEFT JOIN municipios m on m.id = l.id_municipio 
                    LEFT JOIN estados e on e.id = m.id_estado WHERE s.id = $id;";
        if ($result = mysqli_query($conexion, $query))
            $sucursal = $result->fetch_assoc();
    }

    if( $sucursal == null )
        $sucursal = [];

    return $sucursal;
}

function delete_sucursal($id):bool{
    $exito = false;
    include '../../../../config/db.php';

    if( isset($conexion) ) {

        echo $query = "update sucursales set status = 'B' where id = $id";

        if( $insert = mysqli_query($conexion,$query) )
            $exito = true;

    }
    return $exito;
}

function reactivar_sucursal($id):bool{
    $exito = false;
    include '../../../../config/db.php';

    if( isset($conexion) ) {
        echo $query = "update sucursales set status = 'A' where id = $id";

        if( $insert = mysqli_query($conexion,$query) )
            $exito = true;
    }
    return $exito;
}

function add_sucursal($data): bool{
    $exito = false;
    include '../../../../config/db.php';

    if( isset($conexion) ) {
        $sucursal = $data["nombre"];
        $direccion = $data["direccion"];
        $id_colonia = $data["colonia"];
        $id_localidad = $data["localidad"];

        echo $query = "INSERT INTO `sucursales` (`sucursal`, `domicilio`, `id_colonia`, `id_localidad`) VALUES ('$sucursal','$direccion','$id_colonia','$id_localidad')";

        if( $insert = mysqli_query($conexion,$query) ){
            var_dump($insert);
            $exito = true;
        }

    }
    return $exito;
}

function update_sucursal($data): bool{
    $exito = false;
    include '../../../../config/db.php';

    if( isset($conexion) ) {

        $id = $data["id"];
        $sucursal = $data["nombre"];
        $direccion = $data["direccion"];
        $id_colonia = $data["colonia"];
        $query = "UPDATE sucursales set sucursal='$sucursal', domicilio='$direccion', id_colonia='$id_colonia', actualizacion = now() where id='$id'";

        if( $insert = mysqli_query($conexion,$query) ){
            var_dump($insert);
            $exito = true;
        }
    }
    return $exito;
}

function get_parse_fecha($fecha): string{
    if( $fecha == null )
        return "";
    $dateObject = new DateTime($fecha);
    return $dateObject->format('d-m-Y h:i A');
}

function get_estados(): array{
    $estados = [];
    include '../../../../config/db.php';

    if( isset($conexion) ) {
        $query = "select id,estado from estados where status = 'A'";
        if ($result = mysqli_query($conexion, $query))
            while ($row = $result->fetch_assoc())
                array_push($estados, $row);
    }
    return $estados;
}

function get_municipios($id_estado):array{
    $municipios = [];
    include '../../../../config/db.php';

    if( isset($conexion) ) {
        $query = "select id, id_estado,municipio from municipios where status = 'A' and id_estado = $id_estado order by municipio asc";
        if ($result = mysqli_query($conexion, $query))
            while ($row = $result->fetch_assoc())
                array_push($municipios, $row);
    }
    return $municipios;
}

function get_localidades($id_municipio):array{
    $localidades = [];
    include '../../../../config/db.php';

    if( isset($conexion) ) {
        $query = "select id, id_municipio,localidad from localidades where status = 'A' and id_municipio = $id_municipio order by localidad asc";
        if ($result = mysqli_query($conexion, $query))
            while ($row = $result->fetch_assoc())
                array_push($localidades, $row);
    }
    return $localidades;
}

function get_colonias($id_municipio):array{
    $colonias = [];
    include '../../../../config/db.php';

    if( isset($conexion) ) {
        $query = "select id, id_municipio,colonia,cp from colonias where status = 'A' and id_municipio = $id_municipio order by colonia asc";
        if ($result = mysqli_query($conexion, $query))
            while ($row = $result->fetch_assoc())
                array_push($colonias, $row);
    }
    return $colonias;
}