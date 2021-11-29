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

    <script>
        function confirmar(id) {
            if (confirm('¿Estás seguro de querer cancelar este envío?')) {
                window.location = 'borrar.php?id=' + id;
            }
        }

        function openForm() {
            document.getElementById("myForm").style.display = "block";
        }

        function closeForm() {
            document.getElementById("myForm").style.display = "none";
        }

        function openForm2() {
            document.getElementById("factForm").style.display = "block";
        }

        function closeForm2() {
            document.getElementById("factForm").style.display = "none";
        }
    </script>

    <style>
        {
            box-sizing: border-box
        ;
        }

        /* The popup form - hidden by default */
        .form-popup {
            display: none;
            position: absolute;
            bottom: 0;
            border: 3px solid #f1f1f1;
        }

        /* Add styles to the form container */
        .form-container {
            max-width: 300px;
            padding: 10px;
            background-color: white;
        }
    </style>
</head>

<body id="page-top">

<?php getNavbar() ?>

<div id="wrapper">

    <?php getSidebar() ?>

    <div id="content-wrapper">

        <div class="container-fluid">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Envíos</li>
                    <li class="breadcrumb-item active" aria-current="page">Consultas</li>
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
                        <th>Paquetería</th>
                        <th>Costo</th>
                        <th>Num. de guía</th>
                        <th>Estado</th>
                        <th>Origen</th>
                        <th>Destino</th>
                        <th>Fecha de envío</th>
                        <th>Fecha de entrega</th>
                        <th>Factura</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Cliente</th>
                        <th>Paquetería</th>
                        <th>Costo</th>
                        <th>Num. de guía</th>
                        <th>Estado</th>
                        <th>Origen</th>
                        <th>Destino</th>
                        <th>Fecha de envío</th>
                        <th>Fecha de entrega</th>
                        <th>Factura</th>
                        <th>Acciones</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    <?php
                    $x = 0;
                    foreach ($envios as $e) {
                        $cliente = $envios['id_cliente'];
                        $sql = "select nombre,apellidos from clientes where id = '$cliente'";
                        $resultado = mysqli_query($conexion, $sql);
                        $cliente = mysqli_fetch_assoc($resultado);

                        $paqueteria = $envios['paqueteria'];
                        $sql = "select paqueteria from paqueterias where id = '$paqueteria'";
                        $resultado = mysqli_query($conexion, $sql);
                        $paqueteria = mysqli_fetch_assoc($resultado);

                        $origen = $envios['origen'];
                        $sql = "select cp,calle from direcciones where id = '$origen'";
                        $resultado = mysqli_query($conexion, $sql);
                        $origen = mysqli_fetch_assoc($resultado);

                        $destino = $envios['destino'];
                        $sql = "select cp,calle from direcciones where id = '$destino'";
                        $resultado = mysqli_query($conexion, $sql);
                        $destino = mysqli_fetch_assoc($resultado);

                        $estado = '';
                        $bg = '';
                        switch ($envios['seguimiento']) {
                            case 'R':
                                $estado = 'Por recoger';
                                $bg = "#67c9f0";
                                break;
                            case 'C':
                                $estado = 'En camino';
                                $bg = "#f0e267";
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
                            <td><?php echo $cliente['nombre'] . $cliente['apellidos']; ?></td>
                            <td><?php echo $paqueteria['paqueteria']; ?></td>
                            <td><?php echo $envios['costo']; ?></td>
                            <td><?php if ($envios['guia']) {
                                    echo $envios['guia'];
                                } else if ($envios['seguimiento'] != 'C') {
                                    ?>
                                    <button type="submit" class="btn btn-primary btn-sm" onclick="openForm()">Asignar
                                        num. guía
                                    </button>
                                    <div class="form-popup" id="myForm">
                                        <form action="guia.php" class="form-container">
                                            <h1>Número de guía</h1>

                                            <label for="guia" class="form-label"><b>Guía</b></label>
                                            <input type="text" class="form-control" placeholder="Número de guía"
                                                   name="guia" required>
                                            <input type="hidden" name="id" value="<?php echo $e['id'] ?>">

                                            <div class="row my-3">
                                                <div class="col text-right">
                                                    <button type="submit" class="btn btn-primary btn-sm">Registrar
                                                    </button>
                                                    <button class="btn btn-danger btn-sm" onclick="closeForm()">
                                                        Cancelar
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <?php
                                }
                                ?>
                            </td>
                            <td style="background-color: <?php echo $bg; ?>"><?php echo $estado; ?></td>
                            <td><?php echo $origen['cp'] . $origen['calle']; ?></td>
                            <td><?php echo $destino['cp'] . $destino['calle']; ?></td>
                            <td><?php echo $envios['fecha_envio']; ?></td>
                            <td><?php echo $envios['fecha_entrega']; ?></td>
                            <td></td>
                            <td><?php if ($envios['seguimiento'] == 'R') { ?>
                                    <a onclick="confirmar(<?php echo $e['id'] ?>)" href="#"
                                       class="btn btn-danger btn-sm">Cancelar</a>
                                <?php } ?>
                                <button type="submit" class="btn btn-primary btn-sm" onclick="openForm2()">Asignar
                                    factura
                                </button>
                                <div class="form-popup" id="factForm">
                                    <form action="factura.php" class="form-container">
                                        <h1>Número de guía</h1>

                                        <label for="fact" class="form-label"><b>Factura (PDF o XML)</b></label>
                                        <input type="file" class="form-control" name="fact" required>
                                        <input type="hidden" name="id" value="<?php echo $e['id'] ?>">

                                        <div class="row my-3">
                                            <div class="col text-right">
                                                <button type="submit" class="btn btn-primary btn-sm">
                                                    Guardar
                                                </button>
                                                <button class="btn btn-danger btn-sm" onclick="closeForm2()">
                                                    Cancelar
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    <tr>
                        <td>John Doe</td>
                        <td>Estafeta</td>
                        <td>$150.00</td>
                        <td></td>
                        <td style="background-color: #e86d6d">Cancelado</td>
                        <td>93308 Calle Strasse</td>
                        <td>90210 Avenida Rue</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>John Doe</td>
                        <td>Estafeta</td>
                        <td>$150.00</td>
                        <td>
                            <button type="submit" class="btn btn-primary btn-sm" onclick="openForm()">Asignar
                                num. guía
                            </button>
                            <div class="form-popup" id="myForm">
                                <form action="guia.php" class="form-container">
                                    <h1>Número de guía</h1>

                                    <label for="guia" class="form-label"><b>Guía</b></label>
                                    <input type="text" class="form-control" placeholder="Número de guía"
                                           name="guia" required>
                                    <input type="hidden" name="id" value="2">

                                    <div class="row my-3">
                                        <div class="col text-right">
                                            <button type="submit" class="btn btn-primary btn-sm">Registrar
                                            </button>
                                            <button class="btn btn-danger btn-sm" onclick="closeForm()">
                                                Cancelar
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </td>
                        <td style="background-color: #67c9f0">Por recoger</td>
                        <td>93308 Calle Strasse</td>
                        <td>90210 Avenida Rue</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <a onclick="confirmar(2)" href="#" class="btn btn-danger btn-sm">Cancelar</a>
                            <button type="submit" class="btn btn-primary btn-sm" onclick="openForm2()">Asignar
                                factura
                            </button>
                            <div class="form-popup" id="factForm">
                                <form action="factura.php" class="form-container">
                                    <h1>Número de guía</h1>

                                    <label for="fact" class="form-label"><b>Factura (PDF o XML)</b></label>
                                    <input type="file" class="form-control" name="fact" required>
                                    <input type="hidden" name="id" value="<?php echo $e['id'] ?>">

                                    <div class="row my-3">
                                        <div class="col text-right">
                                            <button type="submit" class="btn btn-primary btn-sm">
                                                Guardar
                                            </button>
                                            <button class="btn btn-danger btn-sm" onclick="closeForm2()">
                                                Cancelar
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>John Doe</td>
                        <td>Estafeta</td>
                        <td>$150.00</td>
                        <td>201860457ABC</td>
                        <td style="background-color: #f0e267">En camino</td>
                        <td>93308 Calle Strasse</td>
                        <td>90210 Avenida Rue</td>
                        <td>20-Mar-2021</td>
                        <td></td>
                        <td></td>
                        <td>
                            <button type="submit" class="btn btn-primary btn-sm" onclick="openForm2()">Asignar
                                factura
                            </button>
                            <div class="form-popup" id="factForm">
                                <form action="factura.php" class="form-container">
                                    <h1>Número de guía</h1>

                                    <label for="fact" class="form-label"><b>Factura (PDF o XML)</b></label>
                                    <input type="file" class="form-control" name="fact" required>
                                    <input type="hidden" name="id" value="<?php echo $e['id'] ?>">

                                    <div class="row my-3">
                                        <div class="col text-right">
                                            <button type="submit" class="btn btn-primary btn-sm">
                                                Guardar
                                            </button>
                                            <button class="btn btn-danger btn-sm" onclick="closeForm2()">
                                                Cancelar
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>John Doe</td>
                        <td>Estafeta</td>
                        <td>$150.00</td>
                        <td>201860457ABC</td>
                        <td style="background-color: #6de892">Entregado</td>
                        <td>93308 Calle Strasse</td>
                        <td>90210 Avenida Rue</td>
                        <td>19-Mar-2021</td>
                        <td>21-Mar-2021</td>
                        <td></td>
                        <td></td>
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
