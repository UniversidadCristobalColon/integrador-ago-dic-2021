<?php
require_once '../../../config/global.php';
require '../../../config/db.php';

define('RUTA_INCLUDE', '../../../'); //ajustar a necesidad

$tipo_usuario = $_SESSION['perfil_usuario'];
$mail_user = $_SESSION['email_usuario'];

$date = date("Y-m-d");
$date2 = date_create($date);
$date2 = date_sub($date2, date_interval_create_from_date_string('6 month'));
$date2 = date_format($date2, 'Y-m-d');

$sql = '';
if ($tipo_usuario == 2) {
    $sql = "select id from clientes where email = '$mail_user'";
    $resultado = mysqli_query($conexion, $sql);
    $fila = mysqli_fetch_assoc($resultado);
    $id_cliente = $fila['id'];
    $sql = "select * from envios where status = 'A' AND cliente = '$id_cliente'";
} else {
    $sql = "select * from envios where status = 'A'";
}

if (isset($_GET['pak'])) {
    if ($_GET['pak'] != 'all') {
        $id_pak = $_GET['pak'];
        $sql .= " AND paqueteria = $id_pak";
    }
}

if (isset($_GET['inicio'])) {
    if (isset($_GET['fin'])) {
        $fecha_inicio = $_GET['inicio'] . " 00:00:00";
        $fecha_fin = $_GET['fin'] . " 23:59:59";
        $sql .= " AND creacion BETWEEN '$fecha_inicio' AND '$fecha_fin'";
    } else {
        $fecha_inicio = $_GET['inicio'] . " 00:00:00";
        $sql .= " AND creacion >= '$fecha_inicio'";
    }
} elseif (isset($_GET['fin'])) {
    $fecha_fin = $_GET['fin'] . " 23:59:59";
    $sql .= " AND creacion <= '$fecha_fin'";
} else {
    $datetime = $date . " 23:59:59";
    $datetime2 = $date2 . " 00:00:00";
    $sql .= " AND creacion BETWEEN '$datetime2' AND '$datetime'";
}

$resultado = mysqli_query($conexion, $sql);

$envios = array();
if ($resultado) {
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $envios[] = $fila;
    }
}

$id_tabla_paquetes = '';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo PAGE_TITLE ?></title>
    <?php getTopIncludes(RUTA_INCLUDE) ?>

</head>

<body id="page-top">

<?php getNavbar() ?>

<div id="wrapper">

    <?php getSidebar() ?>

    <div id="content-wrapper">
        <div class="container-fluid">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Consultas</li>
                    <li class="breadcrumb-item active" aria-current="page">Envíos</li>
                </ol>
            </nav>

            <form method="get" action="index.php">
                <div class="form-group row col-sm-8">
                    <label for="staticEmail" class="col-sm-1 col-form-label">Desde:</label>
                    <div class="col-sm-2">
                        <input type="date" class="form-control" name="inicio" id="inicio" value="<?php echo $date2; ?>">
                    </div>
                    <label for="staticEmail" class="col-sm-1 col-form-label">Hasta:</label>
                    <div class="col-sm-2">
                        <input type="date" class="form-control" name="fin" id="fin" value="<?php echo $date; ?>">
                    </div>
                    <label for="staticEmail" class="col-sm-1 col-form-label">Paquetería:</label>
                    <div class="col-sm-2">
                        <select name="pak" id="pak" class="form-control">
                            <option selected value="all"> -- Paquetería --</option>
                            <?php
                            $sql = "select * from paqueterias where status='A'";
                            $resultado = mysqli_query($conexion, $sql);

                            $paqueterias = array();
                            if ($resultado) {
                                while ($fila = mysqli_fetch_assoc($resultado)) {
                                    $paqueterias[] = $fila;
                                }
                            }
                            foreach ($paqueterias as $p) {
                                ?>
                                <option value="<?php echo $p['id']; ?>"><?php echo $p['paqueteria']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-1">
                        <input type="submit" id="go" class="btn btn-primary" value="Buscar">
                    </div>
                    <div class="col-sm-1">
                        <input type="reset" id="back" class="btn btn-primary" value="Reestablecer">
                    </div>
                </div>
            </form>


            <?php
            if (count($envios) > 0) {
                ?>

                <div class="table-responsive mb-3">

                    <table id="env" class="table table-bordered dataTable">
                        <thead>
                        <tr>
                            <?php
                            if ($tipo_usuario == 1) {
                                ?>
                                <th>Cliente</th>
                                <?php
                            }
                            ?>
                            <th>Enviado por</th> <!-- guia, paqueteria -->
                            <th>Estado</th>
                            <th>Servicios</th> <!-- tipo servicio, seguro, recoleccion, factura -->
                            <th>Origen - Destino</th> <!-- desde - hacia -->
                            <th>Detalles</th> <!-- costo, entrega en # dias -->
                            <th>Envío y entrega</th> <!-- envio, entrega -->
                            <th style="display:none;"></th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <?php
                            if ($tipo_usuario == 1) {
                                ?>
                                <th>Cliente</th>
                                <?php
                            }
                            ?>
                            <th>Enviado por</th> <!-- guia, paqueteria -->
                            <th>Estado</th>
                            <th>Servicios</th> <!-- tipo servicio, seguro, recoleccion, factura -->
                            <th>Origen - Destino</th> <!-- desde - hacia -->
                            <th>Detalles</th> <!-- costo, entrega en # dias -->
                            <th>Envío y entrega</th> <!-- envio, entrega -->
                            <th style="display:none;"></th>
                            <th>Acciones</th>
                        </tr>
                        </tfoot>
                        <tbody>

                        <?php
                        foreach ($envios as $e) {
                            $cliente = $e['cliente'];
                            $sql = "select nombre,apellidos from clientes where id = '$cliente'";
                            $resultado = mysqli_query($conexion, $sql);
                            $cliente = mysqli_fetch_assoc($resultado);

                            $paqueteria = $e['paqueteria'];
                            $sql = "select paqueteria,website from paqueterias where id = '$paqueteria'";
                            $resultado = mysqli_query($conexion, $sql);
                            $paqueteria = mysqli_fetch_assoc($resultado);

                            $suc = '';
                            if (!$e['dir_origen'] == null) {
                                $origen = $e['dir_origen'];
                                $sql = "select cp,calle from direcciones where id = '$origen'";
                                $resultado = mysqli_query($conexion, $sql);
                                $origen = mysqli_fetch_assoc($resultado);
                            } else {
                                $suc = 'Sucursal';
                            }

                            $destino = $e['dir_destino'];
                            $sql = "select cp,calle from direcciones where id = '$destino'";
                            $resultado = mysqli_query($conexion, $sql);
                            $destino = mysqli_fetch_assoc($resultado);

                            $estado = '';
                            $idEnv = $e['id'];
                            ?>
                            <tr>
                                <?php
                                if ($tipo_usuario == 1) {
                                    ?>
                                    <td><?php echo $cliente['nombre'] . " " . $cliente['apellidos']; ?></td>
                                    <?php
                                }
                                ?>
                                <td>
                                    <?php echo $paqueteria['paqueteria']; ?><br>
                                    <?php
                                    if (strpos($paqueteria['website'], '{{guia}}')) {
                                        str_replace('{{guia}}', $e['guia'], $paqueteria['website']);
                                    }
                                    $site = $paqueteria['website'];
                                    $guia = $e['guia'];
                                    echo "<a href=$site target='_blank'>$guia</a>";
                                    ?>
                                </td>
                                <?php
                                switch ($e['seguimiento']) {
                                    case 'P':
                                        $estado = 'Pendiente';
                                        echo "<td><p class='badge badge-pill badge-warning'>$estado</p></td>";
                                        break;
                                    case 'C':
                                        $estado = 'En camino';
                                        echo "<td><p class='badge badge-pill badge-info'>$estado</p></td>";
                                        break;
                                    case 'E':
                                        $estado = 'Entregado';
                                        echo "<td><p class='badge badge-pill badge-success'>$estado</p></td>";
                                        break;
                                    case 'X':
                                        $estado = 'Cancelado';
                                        echo "<td><p class='badge badge-pill badge-danger'>$estado</p></td>";
                                        break;
                                }
                                ?>
                                <td>
                                    Servicio: <?php echo $e['tipo_servicio']; ?><br>
                                    Asegurado: <?php if ($e['seguro'] == 'S') {
                                        echo "Si";
                                    } else {
                                        echo "No";
                                    } ?><br>
                                    Recolección: <?php if ($e['recoleccion'] == 'S') {
                                        echo "Si";
                                    } else {
                                        echo "No";
                                    } ?><br>
                                    Factura: <?php if ($e['factura'] == 'S') {
                                        echo "Si";
                                    } else {
                                        echo "No";
                                    } ?>
                                </td>
                                <td>
                                    Desde: <?php
                                    if ($suc == '') {
                                        echo $origen['cp'] . " " . $origen['calle'];
                                    } else {
                                        echo $suc;
                                    } ?><br>
                                    Hacia: <?php echo $destino['cp'] . " " . $destino['calle']; ?>
                                </td>
                                <td>
                                    Costo: $<?php echo $e['costo']; ?><br>
                                    Entrega en <?php echo $e['tiempo_estimado']; ?> días<br>
                                    <button type="button" class="btn btn-link btn-sm btn-sm" data-toggle="modal"
                                            data-target="#paquetes<?php echo $idEnv; ?>">Ver paquetes
                                    </button>

                                    <div class="modal fade" id="paquetes<?php echo $idEnv; ?>" tabindex="-1"
                                         role="dialog"
                                         aria-labelledby="exampleModalLabel"
                                         aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Paquetes</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body table-responsive table-sm">
                                                    <input type="hidden" id="id_muestra_pak">
                                                    <?php
                                                    $envio = $idEnv;
                                                    $sql = "select * from paquetes_enviados where envio = '$envio' AND status='A'";
                                                    $resultado = mysqli_query($conexion, $sql);
                                                    $pak = array();
                                                    if ($resultado) {
                                                        while ($fila = mysqli_fetch_assoc($resultado)) {
                                                            $pak[] = $fila;
                                                        }
                                                    }
                                                    ?>
                                                    <table id="packages" class="table table-bordered">
                                                        <thead>
                                                        <tr>
                                                            <th>Descripción</th>
                                                            <th>Dimensiones</th>
                                                            <th>Cantidad</th>
                                                            <th>Detalles</th>
                                                        </tr>
                                                        </thead>
                                                        <tfoot>
                                                        <tr>
                                                            <th>Descripción</th>
                                                            <th>Dimensiones</th>
                                                            <th>Cantidad</th>
                                                            <th>Detalles</th>
                                                        </tr>
                                                        </tfoot>
                                                        <tbody>
                                                        <?php
                                                        foreach ($pak as $pk) {
                                                            ?>
                                                            <tr>
                                                                <td>
                                                                    <?php echo $pk['descripcion'] ?>
                                                                </td>
                                                                <td>
                                                                    Largo: <?php echo $pk['largo'] ?> cm.<br>
                                                                    Ancho: <?php echo $pk['ancho'] ?> cm.<br>
                                                                    Alto: <?php echo $pk['alto'] ?> cm.<br>
                                                                    Peso: <?php echo $pk['peso'] ?> kg.<br>
                                                                </td>
                                                                <td>
                                                                    <?php echo $pk['cantidad'] ?>
                                                                </td>
                                                                <td>
                                                                    Tipo: <?php echo $pk['tipo'] ?><br>
                                                                    Embalaje: <?php if ($pk['embalaje'] == 'S') {
                                                                        echo "Si";
                                                                    } else {
                                                                        echo "No";
                                                                    } ?><br>
                                                                    Peso vol.: <?php echo $pk['peso_volum'] ?>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Cerrar
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </td>
                                <td>
                                    Envío: <?php echo $e['fecha_envio']; ?><br>
                                    Entrega: <?php echo $e['fecha_entrega']; ?>
                                </td>
                                <td id="creacion" style="display:none;">
                                    <?php echo $e['creacion']; ?>
                                </td>
                                <td>
                                    <?php
                                    $file1 = "factura/factura_{$idEnv}.pdf";
                                    $file2 = "factura/factura_{$idEnv}.xml";
                                    if (!file_exists($file1) && !file_exists($file2) && $tipo_usuario == 1) {
                                        ?>
                                        <a href="#" class="btn btn-link btn-sm btn-sm"
                                           onclick="muestraFact(<?php echo $idEnv; ?>)">Asignar factura</a>
                                        <?php
                                    } else if (file_exists($file1)) {
                                        echo "<a href='$file1' target='_blank' class='btn btn-link btn-sm btn-sm'>Descargar factura</a>";
                                    } else {
                                        echo "<a href='$file2' target='_blank' class='btn btn-link btn-sm btn-sm'>Descargar factura</a>";
                                    }
                                    if (is_null($e['metodo_pago']) && $tipo_usuario == 1) {
                                        ?>
                                        <a href="#" class="btn btn-link btn-sm btn-sm"
                                           onclick="muestraPago(<?php echo $idEnv; ?>)">Agregar info. pago</a>
                                        <?php
                                    }
                                    if ($tipo_usuario == 1) {
                                        ?>
                                        <a href="#" class="btn btn-link btn-sm btn-sm"
                                           onclick="muestraStat(<?php echo $idEnv; ?>)">Actualizar estado</a>
                                        <?php
                                    }
                                    if ($e['seguimiento'] == 'P') {
                                        ?>
                                        <a href="#" class="btn btn-link btn-sm btn-sm"
                                           onclick="muestraCancel(<?php echo $idEnv; ?>)">Cancelar</a>
                                        <?php
                                    }
                                    ?>
                                    <form action="Ticket.php" method="post">
                                        <input type="hidden" name="id_envio" value="<?php echo $e['id'] ?>">
                                        <button type="submit" class="btn btn-link btn-sm btn-sm">Descargar ticket
                                        </button>
                                    </form>

                                </td>

                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
                <?php
            } else {
                echo "<div class='alert alert-warning' role='alert'> <i class='fas fa-exclamation-triangle'></i> Aún no hay envíos. </div>";
            }
            ?>


            <div class="modal fade" id="formFact" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Factura</h5>
                            <button type="button" class="close" data-dismiss="modal"
                                    aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="post" action="factura.php" enctype="multipart/form-data">
                            <div class="modal-body">
                                <label class="form-label">Factura electrónica (PDF
                                    o
                                    XML)</label>
                                <input type="file" class="form-control-file" name="factura"
                                       accept="application/pdf,text/xml" required>
                                <input type="hidden" id="id_form_fact" name="id_form_fact">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                        onclick="resetFact()">Cancelar
                                </button>
                                <button type="submit" class="btn btn-primary">Aceptar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="formPago" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Información de
                                pago</h5>
                            <button type="button" class="close" data-dismiss="modal"
                                    aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="post" action="pago.php">
                            <div class="modal-body">
                                <label for="method" class="form-label">Método de
                                    pago</label>
                                <select name="method" id="method" class="form-control"
                                        aria-label="Default select example">
                                    <option selected disabled value> -- Método de pago --
                                    </option>
                                    <option value="E">Efectivo</option>
                                    <option value="C">Tarjeta de crédito</option>
                                    <option value="D">Tarjeta de débito</option>
                                    <option value="P">Paypal</option>
                                    <option value="H">Cheque</option>
                                    <option value="D">Transferencia bancaria</option>
                                </select>
                                <input type="hidden" id="id_form_pago" name="id_form_pago">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                        onclick="resetPago()">Cancelar
                                </button>
                                <button type="submit" class="btn btn-primary">Aceptar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="formCancel" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Cancelación de
                                envío</h5>
                            <button type="button" class="close" data-dismiss="modal"
                                    aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="post" action="cancel.php">
                            <div class="modal-body">
                                <label for="razon" class="form-label">¿Por qué razón
                                    cancela?</label>
                                <select name="razon" id="razon" class="form-control"
                                        aria-label="Default select example">
                                    <option selected disabled value> -- Razón --</option>
                                    <?php
                                    $sql = "select * from razon_cancela";
                                    $resultado = mysqli_query($conexion, $sql);

                                    $razones = array();
                                    if ($resultado) {
                                        while ($fila = mysqli_fetch_assoc($resultado)) {
                                            $razones[] = $fila;
                                        }
                                    }
                                    foreach ($razones as $r) {
                                        ?>
                                        <option value="<?php echo $r['id']; ?>"><?php echo $r['razon']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <label for="comment">¿Algún comentario?</label>
                                <textarea class="form-control"
                                          placeholder="Escriba su comentario"
                                          name="comment"
                                          id="comment" maxlength="150"></textarea>
                                <input type="hidden" id="id_form_cancel" name="id_form_cancel">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                        onclick="resetCancel()">Cancelar
                                </button>
                                <button type="submit" class="btn btn-primary">Aceptar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="formStat" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Estatus de envío</h5>
                            <button type="button" class="close" data-dismiss="modal"
                                    aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="post" action="actualiza.php">
                            <div class="modal-body">
                                <label for="stat" class="form-label">Estatus del
                                    envío</label>
                                <select name="stat" id="stat" class="form-control"
                                        aria-label="Default select example">
                                    <option selected disabled value> -- Estatus --</option>
                                    <option value="P">Pendiente</option>
                                    <option value="C">En camino</option>
                                    <option value="E">Entregado</option>
                                </select>
                                <input type="hidden" id="id_form_stat" name="id_form_stat">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                        onclick="resetStat()">Cancelar
                                </button>
                                <button type="submit" class="btn btn-primary">Aceptar</button>
                            </div>
                        </form>
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


<script type="text/javascript">

    function muestraFact(idEnv) {
        $('#id_form_fact').val(idEnv);
        $('#formFact').modal('show');
    }

    function muestraCancel(idEnv) {
        $('#id_form_cancel').val(idEnv);
        $('#formCancel').modal('show');
    }

    function muestraPago(idEnv) {
        $('#id_form_pago').val(idEnv);
        $('#formPago').modal('show');
    }

    function muestraStat(idEnv) {
        $('#id_form_stat').val(idEnv);
        $('#formStat').modal('show');
    }

    function resetStat() {
        $('#formStat').modal('hide');
    }

    function resetFact() {
        $('#formFact').modal('hide');
    }

    function resetCancel() {
        $('#formCancel').modal('hide');
    }

    function resetPago() {
        $('#formPago').modal('hide');
    }

</script>

</body>

</html>
