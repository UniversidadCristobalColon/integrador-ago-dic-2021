<?php
require_once '../../../config/global.php';
require '../../../config/db.php';

define('RUTA_INCLUDE', '../../../'); //ajustar a necesidad

$sql = "select * from envios";
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
                    <li class="breadcrumb-item">Catálogos</li>
                    <li class="breadcrumb-item active" aria-current="page">Nombre del catálogo</li>
                </ol>
            </nav>

            <?php
            if (false) {
                ?>
                <div class="alert alert-success" role="alert">
                    <i class="fas fa-check"></i> Mensaje de éxito
                </div>
                <?php
            }
            if (false) {
                ?>
                <div class="alert alert-danger" role="alert">
                    <i class="fas fa-exclamation-triangle"></i> Mensaje de error
                </div>
                <?php
            }
            if (false) {
                ?>
                <div class="row my-3">
                    <div class="col text-right">
                        <button type="button" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo</button>
                    </div>
                </div>
                <?php
            }
            ?>

            <div class="table-responsive mb-3">
                <table class="table table-bordered dataTable">
                    <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Guia</th>
                        <th>Estado</th>
                        <th>Origen</th>
                        <th>Destino</th>
                        <th>Paquetería</th>
                        <th>Tipo de servicio</th>
                        <th>Asegurado</th>
                        <th>Servicio de recolección</th>
                        <th>Costo</th>
                        <th>Tiempo estimado (días)</th>
                        <th>Factura</th>
                        <th>Fecha de envío</th>
                        <th>Fecha de entrega</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Cliente</th>
                        <th>Guia</th>
                        <th>Estado</th>
                        <th>Origen</th>
                        <th>Destino</th>
                        <th>Paquetería</th>
                        <th>Tipo de servicio</th>
                        <th>Asegurado</th>
                        <th>Servicio de recolección</th>
                        <th>Costo</th>
                        <th>Tiempo estimado (días)</th>
                        <th>Factura</th>
                        <th>Fecha de envío</th>
                        <th>Fecha de entrega</th>
                        <th>Acciones</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    <tr>
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

                            $origen = $e['dir_origen'];
                            $sql = "select cp,calle from direcciones where id = '$origen'";
                            $resultado = mysqli_query($conexion, $sql);
                            $origen = mysqli_fetch_assoc($resultado);

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
                            <td><?php echo $cliente['nombre'] . $cliente['apellidos']; ?></td>
                            <td><?php
                                if (strpos($paqueteria['website'], '{{guia}}')) {
                                    str_replace('{{guia}}', $e['guia'], $paqueteria['website']);
                                }
                                $site = $paqueteria['website'];
                                $guia = $e['guia'];
                                echo "<a href=$site target='_blank'>$guia</a>";
                                ?></td>
                            <td style="background-color: <?php echo $bg; ?>"><?php echo $estado; ?></td>
                            <td><?php echo $origen['cp'] . $origen['calle']; ?></td>
                            <td><?php echo $destino['cp'] . $destino['calle']; ?></td>
                            <td><?php echo $paqueteria['paqueteria']; ?></td>
                            <td><?php echo $e['tipo_servicio']; ?></td>
                            <td><?php if ($e['seguro'] == 'S') {
                                    echo "Si";
                                } else {
                                    echo "No";
                                } ?></td>
                            <td><?php if ($e['recoleccion'] == 'S') {
                                    echo "Si";
                                } else {
                                    echo "No";
                                } ?></td>
                            <td><?php echo $e['costo']; ?></td>
                            <td><?php echo $e['tiempo_estimado']; ?></td>
                            <td><?php echo $e['factura']; ?></td>
                            <td><?php echo $e['fecha_envio']; ?></td>
                            <td><?php echo $e['fecha_entrega']; ?></td>
                            <td>
                                <?php
                                $idEnv=$e['id'];
                                $file1 = "/factura/factura_{$idEnv}.pdf";
                                $file2 = "/factura/factura_{$idEnv}.xml";
                                if(!file_exists($file1) && !file_exists($file2)){
                                ?>
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#formFact">
                                    Asignar factura
                                </button>
                                <?php
                                }
                                if(is_null($e['metodo_pago'])){
                                ?>
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#formPago">
                                    Agregar info. pago
                                </button>
                                <?php
                                }
                                if(is_null($e['razon_cancela']) && $e['seguimiento']=='P'){
                                ?>
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#formCancel">
                                    Cancelar
                                </button>
                                <?php
                                }if(true){
                                ?>
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#formStat">
                                    Actualizar estado
                                </button>
                                <?php
                                }
                                ?>

                                <div class="modal fade" id="formFact" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                     aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="post" action="factura.php">
                                                <div class="modal-body">
                                                    <label for="fact" class="form-label"><b>Factura electrónica (PDF o XML)</b></label>
                                                    <input type="file" class="form-control" name="fact" id="fact"  accept="application/pdf,text/xml" required>
                                                    <input type="hidden" name="id" value="<?php echo $e['id'] ?>">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-primary">Aceptar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="formPago" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                     aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="post" action="pago.php">
                                                <div class="modal-body">
                                                    <label for="method" class="form-label"><b>Método de pago</b></label>
                                                    <select name="method" id="method" class="form-select"
                                                            aria-label="Default select example">
                                                        <option selected>Método de pago</option>
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
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-primary">Aceptar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="formCancel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                     aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="post" action="cancel.php">
                                                <div class="modal-body">
                                                    <label for="razon" class="form-label"><b>¿Por qué razón cancela?</b></label>
                                                    <select name="razon" id="razon" class="form-select"
                                                            aria-label="Default select example">
                                                        <option selected>Razón</option>
                                                        <?php
                                                        $sql = "select * from razonCancela";
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
                                                    <textarea class="form-control" placeholder="Escriba su comentario" name="comment"
                                                              id="comment" maxlength="150"></textarea>
                                                    <label for="comment"><b>¿Algún comentario?</b></label>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-primary">Aceptar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="formStat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                     aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="post" action="actualiza.php">
                                                <div class="modal-body">
                                                    <label for="stat" class="form-label"><b>Estatus del envío</b></label>
                                                    <select name="stat" id="stat" class="form-select"
                                                            aria-label="Default select example">
                                                        <option value="P" selected>Pendiente</option>
                                                        <option value="C">En camino</option>
                                                        <option value="E">Entregado</option>
                                                    </select>
                                                    <input type="hidden" name="id" value="<?php echo $e['id'] ?>">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-primary">Aceptar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </td>
                            <?php
                        }
                        ?>
                    </tr>
                    </tbody>
                </table>
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
</body>

</html>
