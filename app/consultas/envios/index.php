<?php
require_once '../../../config/global.php';
require '../../../config/db.php';

define('RUTA_INCLUDE', '../../../'); //ajustar a necesidad

//$tipo_usuario = $_SESSION['perfil_usuario'];
//$mail_user = $_SESSION['email_usuario'];
$mail_user = "prueba@prueba.com";
$tipo_usuario = 1;
$date = date("Y-m-d");
echo "<input id='hoy' type='hidden' value='$date'>";
$date = date_create($date);
$date = date_sub($date, date_interval_create_from_date_string('6 month'));
$date = date_format($date, 'Y-m-d');
echo "<input id='antes' type='hidden' value='$date'>";

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

$resultado = mysqli_query($conexion, $sql);

$envios = array();
if ($resultado) {
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $envios[] = $fila;
    }
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

            <div class="table-responsive mb-3">

                <?php
                if (count($envios) > 0) {
                    ?>

                    <div class="container-fluid col-md-6 offset-md-6">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inicio">Desde</label>
                                <input type="date" class="form-control" id="inicio">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="fin">Hasta</label>
                                <input type="date" class="form-control" id="fin">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="pak">Paquetería</label>
                                <select name="pak" id="pak" class="form-control">
                                    <option selected disabled value> -- Paquetería -- </option>
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
                        </div>
                        <div class="form-row">
                            <div class="form-group text-md-right col-md-2 offset-10">
                                <input type="reset" id="back" class="btn btn-primary" value="Reestablecer">
                            </div>
                        </div>
                    </div>

                    <table class="table table-bordered dataTable">
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
                            $bg = '';
                            switch ($e['seguimiento']) {
                                case 'P':
                                    $estado = 'Pendiente';
                                    $bg = "#f0e267";
                                    break;
                                case 'C':
                                    $estado = 'En camino';
                                    $bg = "#67c9f0";
                                    break;
                                case 'E':
                                    $estado = 'Entregado';
                                    $bg = "#6de892";
                                    break;
                                case 'X':
                                    $estado = 'Cancelado';
                                    $bg = "#e86d6d";
                                    break;
                            }


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
                                <td style="background-color: <?php echo $bg; ?>"><?php echo $estado; ?></td>
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
                                    <a href="#" class="btn btn-link btn-sm btn-sm" data-toggle="modal"
                                       data-target="#paquetes">Info. de paquetes</a>
                                </td>
                                <td>
                                    Envío: <?php echo $e['fecha_envio']; ?><br>
                                    Entrega: <?php echo $e['fecha_entrega']; ?>
                                </td>
                                <td>
                                    <?php
                                    $idEnv = $e['id'];
                                    $file1 = "factura/factura_{$idEnv}.pdf";
                                    $file2 = "factura/factura_{$idEnv}.xml";
                                    if (!file_exists($file1) && !file_exists($file2) && $tipo_usuario == 1) {
                                        ?>
                                        <a href="#" class="btn btn-link btn-sm btn-sm" data-toggle="modal"
                                           data-target="#formFact">Asignar factura</a>
                                        <?php
                                    } else if (file_exists($file1)) {
                                        echo "<a href='$file1' target='_blank' class='btn btn-link btn-sm btn-sm'>Descargar factura</a>";
                                    } else {
                                        echo "<a href='$file2' target='_blank' class='btn btn-link btn-sm btn-sm'>Descargar factura</a>";
                                    }
                                    if (is_null($e['metodo_pago']) && $tipo_usuario == 1) {
                                        ?>
                                        <a href="#" class="btn btn-link btn-sm btn-sm" data-toggle="modal"
                                           data-target="#formPago">Agregar info. pago</a>
                                        <?php
                                    }
                                    if ($tipo_usuario == 1) {
                                        ?>
                                        <a href="#" class="btn btn-link btn-sm btn-sm" data-toggle="modal"
                                           data-target="#formStat">Actualizar estado</a>
                                        <?php
                                    }
                                    if ($e['seguimiento'] == 'P') {
                                        ?>
                                        <a href="#" class="btn btn-link btn-sm btn-sm" data-toggle="modal"
                                           data-target="#formCancel">Cancelar</a>
                                        <?php
                                    }
                                    ?>
                                    <form action="Ticket.php" method="post">
                                        <input type="hidden" name="id_envio" value="<?php echo $e['id'] ?>">
                                        <button class="btn btn-link btn-sm btn-sm">Descargar ticket</button>
                                    </form>

                                    <div class="modal fade" id="paquetes" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalLabel"
                                         aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Cerrar
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="formFact" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalLabel"
                                         aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="post" action="factura.php" enctype="multipart/form-data">
                                                    <div class="modal-body">
                                                        <label class="form-label"><b>Factura electrónica (PDF
                                                                o
                                                                XML)</b></label>
                                                        <input type="file" class="form-control-file" name="factura"
                                                               accept="application/pdf,text/xml" required>
                                                        <input type="hidden" name="id" value="<?php echo $e['id'] ?>">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Cancelar
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
                                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="post" action="pago.php">
                                                    <div class="modal-body">
                                                        <label for="method" class="form-label"><b>Método de
                                                                pago</b></label>
                                                        <select name="method" id="method" class="form-control"
                                                                aria-label="Default select example">
                                                            <option selected disabled value> -- Método de pago -- </option>
                                                            <option value="E">Efectivo</option>
                                                            <option value="C">Tarjeta de crédito</option>
                                                            <option value="D">Tarjeta de débito</option>
                                                            <option value="P">Paypal</option>
                                                            <option value="H">Cheque</option>
                                                            <option value="D">Transferencia bancaria</option>
                                                        </select>
                                                        <input type="hidden" name="id" value="<?php echo $e['id'] ?>">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Cancelar
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
                                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="post" action="cancel.php">
                                                    <div class="modal-body">
                                                        <label for="razon" class="form-label"><b>¿Por qué razón
                                                                cancela?</b></label>
                                                        <select name="razon" id="razon" class="form-control"
                                                                aria-label="Default select example">
                                                            <option selected disabled value> -- Razón -- </option>
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
                                                        <label for="comment"><b>¿Algún comentario?</b></label>
                                                        <textarea class="form-control"
                                                                  placeholder="Escriba su comentario"
                                                                  name="comment"
                                                                  id="comment" maxlength="150"></textarea>
                                                        <input type="hidden" name="id" value="<?php echo $e['id'] ?>">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Cancelar
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
                                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="post" action="actualiza.php">
                                                    <div class="modal-body">
                                                        <label for="stat" class="form-label"><b>Estatus del
                                                                envío</b></label>
                                                        <select name="stat" id="stat" class="form-select"
                                                                aria-label="Default select example">
                                                            <option selected disabled value> -- Estatus -- </option>
                                                            <option value="P">Pendiente</option>
                                                            <option value="C">En camino</option>
                                                            <option value="E">Entregado</option>
                                                        </select>
                                                        <input type="hidden" name="id" value="<?php echo $e['id'] ?>">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Cancelar
                                                        </button>
                                                        <button type="submit" class="btn btn-primary">Aceptar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                </td>

                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                    <?php
                } else {
                    echo "<div class='alert alert-warning' role='alert'> <i class='fas fa-exclamation-triangle'></i> Aún no hay envíos. </div>";
                }
                ?>
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

<script>
    $("#back").click(function(){
        $("tr").show();
        var hoy = $('hoy').val();
        var antes = $('antes').val();
        $('#inicio').val(antes);
        $('#fin').val(hoy);
        $('#pak').prop('selectedIndex',0);
    });

    $('#inicio').on('change',function(evento){
        var start = "Envío: " + $('#inicio').val();
        $("td").filter(function() {
            return $(this).text().indexOf(start) !== -1;
        }).parent().hide();
    });

    $('#fin').on('change',function(evento){
        var endgame = "Envío: " + $('#fin').val();
        $("td").filter(function() {
            return $(this).text().indexOf(endgame) !== -1;
        }).parent().hide();
    });

    $('#pak').on('change',function(evento){
        var paq = $('#pak').text();
        $("td").filter(function() {
            return $(this).text().indexOf(paq) !== -1;
        }).parent().hide();
    });
</script>

</body>

</html>