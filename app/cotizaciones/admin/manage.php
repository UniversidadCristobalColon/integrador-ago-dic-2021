<?php
require_once '../../../config/global.php';
require '../../../config/db.php';
define('RUTA_INCLUDE', '../../../'); //ajustar a necesidad
?>
<?php
$id_cotizacion = $_GET['id'];
// CONSULTA INFORMACIÓN DE LA COTIZACIÓN SELECCIONADA
$sqlCotizacion = "SELECT CONCAT(cli.nombre, ' ', cli.apellidos) AS cliente,
        CONCAT(dir_rem.calle, ' #', dir_rem.num_exterior, ', Entre ', dir_rem.entre_calles, ' C.P. ', dir_rem.cp) AS dir_rem,
        CONCAT(dir_dest.calle, ' #', dir_dest.num_exterior, ', Entre ', dir_dest.entre_calles, ' C.P. ', dir_dest.cp) AS dir_dest,
        cotiz.tipo_servicio, cotiz.asegurado, cotiz.factura, cotiz.recoleccion, cotiz.fecha_creacion, cotiz.fecha_respuesta, cotiz.fecha_resolucion, cotiz.actualizacion, cotiz.guia, cotiz.status FROM cotizaciones cotiz INNER JOIN clientes cli ON cli.id = cotiz.id_cliente INNER JOIN direcciones dir_rem ON dir_rem.id = cotiz.id_dir_rem
        INNER JOIN direcciones dir_dest ON dir_dest.id = cotiz.id_dir_dest WHERE cotiz.id_cotizacion = $id_cotizacion";
$result = mysqli_query($conexion, $sqlCotizacion);
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $cliente = $row['cliente'];
    $dir_rem = $row['dir_rem'];
    $dir_dest = $row['dir_dest'];
    $tipo_servicio = $row['tipo_servicio'];
    $asegurado = $row['asegurado'];
    $factura = $row['factura'];
    $recoleccion = $row['recoleccion'];
    $fecha_creacion = $row['fecha_creacion'];
    $fecha_respuesta = $row['fecha_respuesta'];
    $fecha_resolucion = $row['fecha_resolucion'];
    $actualizacion = $row['actualizacion'];
    $guia = $row['guia'];
    $status = $row['status'];
} else {
    mysqli_error($conexion);
}
// CONSULTA DEL LISTADO DE PAQUETERIAS ACTIVAS
$sqlPaqueterias = "SELECT id, paqueteria FROM paqueterias WHERE status = 'A';";
$result = mysqli_query($conexion, $sqlPaqueterias);
$paqueterias = array();
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $paqueterias[] = $row;
    }
    // var_dump($paqueterias);
} else {
    mysqli_error($conexion);
}
// CONSULTA DE PAQUETES COTIZADOS
$sqlPaquetesCotizados = "SELECT * FROM paquetecotizado WHERE id_cotizacion = $id_cotizacion";
$result = mysqli_query($conexion, $sqlPaquetesCotizados);
$paquetesCotizados = array();
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $paquetesCotizados[] = $row;
    }
    //  var_dump($paquetesCotizados);
} else {
    mysqli_error($conexion);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title><?php echo PAGE_TITLE ?></title>


    <?php getTopIncludes(RUTA_INCLUDE) ?>
</head>

<body id="page-top">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <?php getNavbar() ?>

    <div id="wrapper">

        <?php getSidebar() ?>

        <div id="content-wrapper">

            <div class="container-fluid">

                <!-- Page Content -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Cotizaciones</li>
                        <li class="breadcrumb-item" aria-current="page">Admin</li>
                        <li class="breadcrumb-item active" aria-current="page">Cotización <?php echo $id_cotizacion ?></li>
                    </ol>
                </nav>

                <!-- Tarjeta resumen + Añadir Servicios -->
                <div class="row">
                    <div class="col-xl-5 col-lg-5 col-md-10 col-sm-11 mb-3">
                        <!-- Tarjeta de resumen -->
                        <div class="card bg-light">
                            <h6 class="card-header">Resumen de cotización</h6>
                            <div class="card-body">
                                <h5 class="card-title"><a data-bs-toggle="offcanvas" href="#quotationDetail" role="button" aria-controls="offcanvasRight"><u>Cotización #<?php echo $id_cotizacion ?></u></a></h5>
                                <label type="text" class="card-text w-100">Origen</label>
                                <input type="text" class="card-text w-100" <?php if (is_null($dir_rem)) { ?> value="N/A" <?php } else { ?> value="<?php echo $dir_rem ?>" <?php } ?> disabled="disabled">
                                <br>
                                <label type="text" class="card-text w-100">Destino</label>
                                <input type="text" class="card-text w-100 mb-3" value="<?php echo $dir_dest ?>" disabled="disabled"><br>
                                <?php if (count($paquetesCotizados) > 1) { ?>
                                    <div class="mb-2">Paquetes en cotización (<?php echo count($paquetesCotizados) ?>)</div>
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                        <?php $contador = 0; ?>
                                        <?php foreach ($paquetesCotizados as $one) { ?>

                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="flush-heading<?php echo $contador ?>">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?php echo $contador ?>" aria-expanded="false" aria-controls="flush-collapse<?php echo $contador ?>">
                                                        Paquete <?php echo $contador + 1 ?>
                                                    </button>
                                                </h2>
                                                <div id="flush-collapse<?php echo $contador ?>" class="accordion-collapse collapse" aria-labelledby="flush-heading<?php echo $contador ?>" data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="ml-2">
                                                                    <div>Tipo</div>
                                                                    <div class="fs-6 font-weight-light">
                                                                        <?php echo $one['tipo'] ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="ml-2">
                                                                    <div>Peso volumétrico</div>
                                                                    <div class="fs-6 font-weight-light">
                                                                        <?php echo $one['peso_volum'] ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-4">
                                                                <div class="ml-2">
                                                                    <div>Peso (KG)</div>
                                                                    <div class="fs-6 font-weight-light">
                                                                        <?php echo $one['peso'] ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-4">
                                                                <div class="ml-2">
                                                                    <div>Largo (CM)</div>
                                                                    <div class="fs-6 font-weight-light">
                                                                        <?php echo $one['largo'] ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-4">
                                                                <div class="ml-2">
                                                                    <div>Ancho (CM)</div>
                                                                    <div class="fs-6 font-weight-light">
                                                                        <?php echo $one['ancho'] ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-4">
                                                                <div class="ml-2">
                                                                    <div>Alto (CM)</div>
                                                                    <div class="fs-6 font-weight-light">
                                                                        <?php echo $one['alto'] ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-4">
                                                                <div class="ml-2">
                                                                    <div>Embalaje</div>
                                                                    <div class="fs-6 font-weight-light">
                                                                        <?php echo $one['embalaje'] ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-4">
                                                                <div class="ml-2">
                                                                    <div>Cantidad</div>
                                                                    <div class="fs-6 font-weight-light">
                                                                        <?php echo $one['cantidad'] ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="ml-2">
                                                                    <div>Descripción</div>
                                                                    <div class="fs-6 font-weight-light">
                                                                        <?php echo $one['descripcion'] ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <?php $contador += 1; ?>
                                        <?php } ?>
                                    </div>
                                <?php } else { ?>
                                    <div>
                                        <?php foreach ($paquetesCotizados as $one) { ?>
                                            <div class="row">
                                                <div class="col-6">
                                                    <label type="text" class="w-100">Largo (CM)</label><br>
                                                    <input type="text" class="w-100" disabled="disabled" value="<?php echo $one['largo'] ?>">
                                                </div>
                                                <div class="col-6">
                                                    <label type="text" class="w-100">Ancho (CM)</label><br>
                                                    <input type="text" class="w-100" disabled="disabled" value="<?php echo $one['ancho'] ?>">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <label type="text" class="w-100">Alto (CM)</label><br>
                                                    <input type="text" class="w-100" disabled="disabled" value="<?php echo $one['alto'] ?>">
                                                </div>
                                                <div class="col-6">
                                                    <label type="text" class="w-100">Peso (KG)</label><br>
                                                    <input type="text" class="w-100" disabled="disabled" value="<?php echo $one['peso'] ?>">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <label type="text" class="w-100">Embalaje</label><br>
                                                    <input type="text" class="w-100" disabled="disabled" value="<?php echo $one['embalaje'] ?>">
                                                </div>
                                                <div class="col-6">
                                                    <label type="text" class="w-100">Cantidad</label><br>
                                                    <input type="text" class="w-100" disabled="disabled" value="<?php echo $one['cantidad'] ?>">
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                    <!-- Sección añadir servicios/servicios propuestos -->
                    <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 mb-3">
                        <?php if ($status == 0) { ?>
                            <h2>Añadir servicios</h2>
                        <?php } else if ($status == 1) { ?>
                            <h2>Servicios propuestos</h2>
                        <?php } else if ($status == 2) { ?>
                            <h2>Servicio seleccionado</h2>
                        <?php } else if ($status == 3) { ?>
                            <h2>Envío realizado con</h2>
                        <?php } ?>
                        <hr>
                        <!-- field_wrapper -->
                        <?php if ($status == 0) { ?>

                            <div class="row">
                                <div class="col-3">
                                    <h5>Paqueteria</h5>
                                </div>
                                <div class="col-4">
                                    <h5>Tiempo estimado</h5>
                                </div>
                                <div class="col-4">
                                    <h5>Precio</h5>
                                </div>
                                <div class="col-1"></div>
                            </div>
                            <form action="config/submitServices.php" method="post">
                                <div class="field_wrapper">
                                    <div class="row">
                                        <div class="col-3 w-100">
                                            <select name="paqueteria_id[]" class="w-100 myOwnSelect" required>
                                                <?php
                                                foreach ($paqueterias as $one) {
                                                ?>
                                                    <option value="<?php echo $one['id'] ?>"><?php echo $one['paqueteria'] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-4 w-100">
                                            <input type="text" class="w-100" name="tiempo_name[]" required>
                                        </div>
                                        <div class="col-4 w-100">
                                            <input type="text" class="w-100" name="precio_name[]" required>
                                        </div>
                                        <div class="col-1 w-100">
                                            <input type="hidden" name="id_cotizacion" value="<?php echo $id_cotizacion ?>">
                                            <a href="javascript:void(0)" class="add_button"><i class="fas fa-plus text-body"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center row mt-3">
                                    <div class="col-2">
                                        <input type="submit" name="submit" value="Enviar" class="btn btn-danger">
                                    </div>
                                </div>
                            </form>

                        <?php } else if ($status == 1) { ?>

                            <?php
                            $sqlServiciosDisponibles = "SELECT paqueteria, tiempo_estimado, precio FROM servicios_disponibles sd INNER JOIN paqueterias pa ON pa.id = sd.id_paqueteria WHERE id_cotizacion = $id_cotizacion;";
                            $result = mysqli_query($conexion, $sqlServiciosDisponibles);
                            $serviciosDisponibles = array();
                            if ($result) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $serviciosDisponibles[] = $row;
                                }
                            } else {
                                echo mysqli_error($conexion);
                            }
                            ?>
                            <div class="row">
                                <div class="col-4">
                                    <h5>Paqueteria</h5>
                                </div>
                                <div class="col-4">
                                    <h5>Tiempo estimado</h5>
                                </div>
                                <div class="col-4">
                                    <h5>Precio</h5>
                                </div>
                            </div>
                            <?php foreach ($serviciosDisponibles as $one) { ?>
                                <div>
                                    <div class="row">
                                        <div class="col-4 w-100">
                                            <input type="text" class="w-100" value="<?php echo $one['paqueteria'] ?>" disabled>
                                        </div>
                                        <div class="col-4 w-100">
                                            <input type="text" class="w-100" value="<?php echo $one['tiempo_estimado'] ?>" disabled>
                                        </div>
                                        <div class="col-4 w-100">
                                            <input type="text" class="w-100" value="<?php echo $one['precio'] ?>" disabled>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="d-flex justify-content-center row mt-4">
                                <div class="col-12 text-center">
                                    <h6>Propuestas enviadas, esperando respuesta del cliente.</h6>
                                </div>
                            </div>

                        <?php } else if ($status == 2) { ?>

                            <?php
                            $sqlServicioElegido = "SELECT id_servicio_disponible, paqueteria, tiempo_estimado, precio FROM servicios_disponibles sd INNER JOIN paqueterias pa ON pa.id = sd.id_paqueteria WHERE id_cotizacion = $id_cotizacion AND sd.status='S';";
                            $result = mysqli_query($conexion, $sqlServicioElegido);
                            $servicioElegido = array();
                            if ($result) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $servicioElegido[] = $row;
                                }
                            } else {
                                echo mysqli_error($conexion);
                            }
                            ?>
                            <div class="row">
                                <div class="col-4">
                                    <h5>Paqueteria</h5>
                                </div>
                                <div class="col-4">
                                    <h5>Tiempo estimado</h5>
                                </div>
                                <div class="col-4">
                                    <h5>Precio</h5>
                                </div>
                            </div>
                            <?php foreach ($servicioElegido as $one) { ?>
                                <div class="row">
                                    <div class="col-4 w-100">
                                        <input type="text" value="<?php echo $one['paqueteria'] ?>" disabled="disabled">
                                    </div>
                                    <div class="col-4 w-100">
                                        <input type="text" value="<?php echo $one['tiempo_estimado'] ?>" disabled="disabled">
                                    </div>
                                    <div class="col-4 w-100">
                                        <input type="text" value="<?php echo $one['precio'] ?>" disabled="disabled">
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="row mt-4">
                                <div class="col-12 text-center">
                                    <h5 class="mt-3">Escriba la guía correspondiente a este envío:</h5>
                                </div>
                                <div class="col-12 text-center">
                                    <form action="config/submitGuia.php" method="post">
                                        <input type="text" class="text-center w-50" name="guia" required>
                                        <input type="hidden" name="id_cotizacion" value="<?php echo $id_cotizacion ?>">
                                        <input type="submit" name="submit" value="Enviar" class="btn btn-danger">
                                    </form>
                                </div>
                            </div>

                        <?php } else if ($status == 3) { ?>

                            <?php
                            $sqlServicioElegido = "SELECT id_servicio_disponible, paqueteria, tiempo_estimado, precio FROM servicios_disponibles sd INNER JOIN paqueterias pa ON pa.id = sd.id_paqueteria WHERE id_cotizacion = $id_cotizacion AND sd.status='S';";
                            $result = mysqli_query($conexion, $sqlServicioElegido);
                            $servicioElegido = array();
                            if ($result) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $servicioElegido[] = $row;
                                }
                            } else {
                                echo mysqli_error($conexion);
                            }
                            ?>
                            <div class="row">
                                <div class="col-4">
                                    <h5>Paqueteria</h5>
                                </div>
                                <div class="col-4">
                                    <h5>Tiempo estimado</h5>
                                </div>
                                <div class="col-4">
                                    <h5>Precio</h5>
                                </div>
                            </div>
                            <?php foreach ($servicioElegido as $one) { ?>
                                <div class="row">
                                    <div class="col-4 w-100">
                                        <input type="text" value="<?php echo $one['paqueteria'] ?>" disabled="disabled">
                                    </div>
                                    <div class="col-4 w-100">
                                        <input type="text" value="<?php echo $one['tiempo_estimado'] ?>" disabled="disabled">
                                    </div>
                                    <div class="col-4 w-100">
                                        <input type="text" value="<?php echo $one['precio'] ?>" disabled="disabled">
                                    </div>
                                </div>
                            <?php } ?>
                            <?php
                            $sqlGuia = "SELECT guia FROM cotizaciones WHERE id_cotizacion = $id_cotizacion";
                            $result = mysqli_query($conexion, $sqlGuia);
                            $guiaEnvio = array();
                            if ($result) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $guiaEnvio[] = $row;
                                }
                            } else {
                                echo mysqli_error($conexion);
                            }
                            ?>
                            <?php foreach ($guiaEnvio as $one) { ?>
                                <div class="row mt-4">
                                    <div class="col-12 text-center">
                                        <h5 class="mt-3">La guía de este envío es:</h5>
                                        <input type="text" class="text-center w-50" value="<?php echo $one['guia'] ?>" readonly="readonly">
                                    </div>
                                </div>
                            <?php } ?>

                        <?php } ?>
                    </div>
                </div>

                <!-- OFFCANVAS - DETALLE COTIZACIÓN -->
                <div>
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="quotationDetail" aria-labelledby="offcanvasRightLabel">
                        <div class="offcanvas-header">
                            <h5 id="offcanvasRightLabel">Cotización #<?php echo $id_cotizacion ?></h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <!-- Detalles -->
                            <div class="row mb-3">
                                <h6>DETALLES</h6>
                                <div class="col-6">
                                    <div class="ml-2">
                                        <div>Cliente</div>
                                        <div class="fs-6 font-weight-light"><?php echo $cliente ?></div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="ml-2">
                                        <div>Fecha de solicitud</div>
                                        <div class="fs-6 font-weight-light"><?php echo $fecha_creacion ?></div>
                                    </div>
                                </div>
                                <div class="ml-2">
                                    <div>Dirección de remitente</div>
                                    <div class="fs-6 font-weight-light"><?php echo $dir_rem ?></div>
                                </div>
                                <div class="ml-2">
                                    <div>Dirección de destinatario</div>
                                    <div class="fs-6 font-weight-light"><?php echo $dir_dest ?></div>
                                </div>
                            </div>
                            <!-- Servicio -->
                            <div class="row mb-3">
                                <h6>SERVICIO</h6>
                                <div class="col-4">
                                    <div class="ml-2">
                                        <div>Tipo</div>
                                        <div class="fs-6 font-weight-light"><?php echo $tipo_servicio ?></div>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="ml-2">
                                        <div>Estatus</div>
                                        <div class="fs-6 font-weight-light">
                                            <?php if ($status == 0) { ?>
                                                Responda la cotización...
                                            <?php } ?>
                                            <?php if ($status == 1) { ?>
                                                Esperando respuesta del cliente...
                                            <?php } ?>
                                            <?php if ($status == 2) { ?>
                                                Cliente seleccionó. Envíe la guía...
                                            <?php } ?>
                                            <?php if ($status == 3) { ?>
                                                Cotización resuelta.
                                            <?php } ?>
                                            <?php if ($status == 4) { ?>
                                                Borrado/Cancelado
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="ml-2">
                                        <div>Asegurado</div>
                                        <div class="fs-6 font-weight-light">
                                            <?php if ($asegurado == 'S') { ?>
                                                Sí
                                            <?php } ?>
                                            <?php if ($asegurado == 'N') { ?>
                                                No
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="ml-2">
                                        <div>Factura</div>
                                        <div class="fs-6 font-weight-light">
                                            <?php if ($factura == 'S') { ?>
                                                Sí
                                            <?php } ?>
                                            <?php if ($factura == 'N') { ?>
                                                No
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="ml-2">
                                        <div>Recolección</div>
                                        <div class="fs-6 font-weight-light">
                                            <?php if ($recoleccion == 'S') { ?>
                                                Sí
                                            <?php } ?>
                                            <?php if ($recoleccion == 'N') { ?>
                                                No
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <?php if (!is_null($guia)) { ?>
                                    <div class="col-12">
                                        <div class="ml-2">
                                            <div>GUÍA</div>
                                            <div class="fs-6 font-weight-light">
                                                <?php echo $guia ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <!-- Paquetes -->
                            <div class="row mb-3">
                                <?php if (count($paquetesCotizados) > 1) { ?>
                                    <h6>PAQUETES</h6>
                                <?php } else { ?>
                                    <h6>PAQUETE</h6>
                                <?php } ?>
                                <!-- Listado de paquetes -->
                                <div class="col-12">
                                    <div>
                                        <?php if (count($paquetesCotizados) > 1) { ?>
                                            <div class="mb-2">En cotización (<?php echo count($paquetesCotizados) ?>)</div>
                                            <div class="accordion accordion-flush" id="accordionFlushExample2">
                                                <?php $contador2 = 10; ?>
                                                <?php foreach ($paquetesCotizados as $one) { ?>

                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="flush-heading<?php echo $contador2 ?>">
                                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?php echo $contador2 ?>" aria-expanded="false" aria-controls="flush-collapse<?php echo $contador2 ?>">
                                                                Paquete <?php echo $contador2 - 9 ?>
                                                            </button>
                                                        </h2>
                                                        <div id="flush-collapse<?php echo $contador2 ?>" class="accordion-collapse collapse" aria-labelledby="flush-heading<?php echo $contador2 ?>" data-bs-parent="#accordionFlushExample2">
                                                            <div class="accordion-body">
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <div class="ml-2">
                                                                            <div>Tipo</div>
                                                                            <div class="fs-6 font-weight-light">
                                                                                <?php echo $one['tipo'] ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="ml-2">
                                                                            <div>Peso volumétrico</div>
                                                                            <div class="fs-6 font-weight-light">
                                                                                <?php echo $one['peso_volum'] ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="ml-2">
                                                                            <div>Peso (KG)</div>
                                                                            <div class="fs-6 font-weight-light">
                                                                                <?php echo $one['peso'] ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="ml-2">
                                                                            <div>Largo (CM)</div>
                                                                            <div class="fs-6 font-weight-light">
                                                                                <?php echo $one['largo'] ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="ml-2">
                                                                            <div>Ancho (CM)</div>
                                                                            <div class="fs-6 font-weight-light">
                                                                                <?php echo $one['ancho'] ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="ml-2">
                                                                            <div>Alto (CM)</div>
                                                                            <div class="fs-6 font-weight-light">
                                                                                <?php echo $one['alto'] ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="ml-2">
                                                                            <div>Embalaje</div>
                                                                            <div class="fs-6 font-weight-light">
                                                                                <?php echo $one['embalaje'] ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="ml-2">
                                                                            <div>Cantidad</div>
                                                                            <div class="fs-6 font-weight-light">
                                                                                <?php echo $one['cantidad'] ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="ml-2">
                                                                            <div>Descripción</div>
                                                                            <div class="fs-6 font-weight-light">
                                                                                <?php echo $one['descripcion'] ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php $contador2 += 1; ?>
                                                <?php } ?>
                                            </div>
                                        <?php } else { ?>
                                            <div>
                                                <?php foreach ($paquetesCotizados as $one) { ?>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="ml-2">
                                                                <div>Tipo</div>
                                                                <div class="fs-6 font-weight-light"><?php echo $one['tipo'] ?></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="ml-2">
                                                                <div>Peso volumétrico</div>
                                                                <div class="fs-6 font-weight-light"><?php echo $one['peso_volum'] ?></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="ml-2">
                                                                <div>Peso (KG)</div>
                                                                <div class="fs-6 font-weight-light"><?php echo $one['peso'] ?></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="ml-2">
                                                                <div>Largo (CM)</div>
                                                                <div class="fs-6 font-weight-light"><?php echo $one['largo'] ?></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="ml-2">
                                                                <div>Ancho (CM)</div>
                                                                <div class="fs-6 font-weight-light"><?php echo $one['ancho'] ?></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="ml-2">
                                                                <div>Alto (CM)</div>
                                                                <div class="fs-6 font-weight-light"><?php echo $one['alto'] ?></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="ml-2">
                                                                <div>Embalaje</div>
                                                                <div class="fs-6 font-weight-light"><?php echo $one['embalaje'] ?></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="ml-2">
                                                                <div>Cantidad</div>
                                                                <div class="fs-6 font-weight-light"><?php echo $one['cantidad'] ?></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="ml-2">
                                                                <div>Descripción</div>
                                                                <div class="fs-6 font-weight-light"><?php echo $one['descripcion'] ?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

            <?php getFooter() ?>

        </div>
        <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <?php getModalLogout() ?>

    <?php getBottomIncudes(RUTA_INCLUDE) ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        var js_array = <?php echo json_encode($paqueterias); ?>;
    </script>
    <script src="js/scriptManage.js"></script>
</body>

</html>