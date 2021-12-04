<?php

require_once '../../config/global.php';
require_once '../../config/db.php';

define('RUTA_INCLUDE', '../../'); //ajustar a necesidad

function obtenerDirecciones($conexion) {

    $selectDirecciones = "
        SELECT 
            id,
            cp,
            calle,
            num_exterior,
            num_interior,
            entre_calles,
            referencia
            FROM `direcciones`
            WHERE id_cliente = 23;";

    $resultado = mysqli_query($conexion, $selectDirecciones);

    if($resultado) {

        while( $fila = mysqli_fetch_assoc($resultado)) {
            $direcciones[] = $fila;
        }

        return $direcciones;

    } else {

        echo mysqli_error($conexion);

    }

    return false;

}

$direcciones = obtenerDirecciones($conexion);


?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <script type="text/javascript">
        /*window.onload = function() {
            if (window.jQuery) {
                // jQuery is loaded
                alert("Yeah!");
            } else {
                // jQuery is not loaded
                alert("Doesn't Work");
            }
        }*/

        var numPaquete = 1;

        function procesarPaquete() {
            var tipoProducto = $("#inputProducto option:selected").val();

            var embalaje = 'N';

            if($("#embalaje").is(":checked")) {
                embalaje = 'S';
            }


            var peso = $("#inputPeso").val();
            var largo = $("#inputLargo").val();
            var ancho = $("#inputAncho").val();
            var alto = $("#inputAlto").val();
            var cantidad = $("#inputCantidad").val();
            var descProducto = $("#descProducto").val();

            var stringPaquete = tipoProducto + "," + embalaje + "," + peso + "," + largo + "," + ancho + "," + alto + "," + cantidad;


            var renglonPaquetes = "" +
                "<tr>" +
                "<th scope='row'>"+ numPaquete + "</th>" +
                "<td>"+ tipoProducto + "</td>" +
                "<td>" + embalaje + "</td>" +
                "<td>" + peso + "</td>" +
                "<td>" + largo + "x" + ancho + "x" + alto + "</td>" +
                "<td>" + cantidad + "</td>" +
                "<td>qqwetd</td>" +
                "</tr>";

            //$("#paquetes tr:last").append(renglonPaquetes);
            //$("#paquetes tbody tr:last").append(renglonPaquetes);
            var numFilasTabla = $("#paquetes tbody tr").length;

            if(numFilasTabla == 0) {
                $("#paquetes tbody").append(renglonPaquetes);
            } else if(numFilasTabla > 0) {
                $("#paquetes tr:last").after(renglonPaquetes);
            }

            numPaquete++;

            //alert(stringPaquete);.

            $("#datosPaquetes").val(stringPaquete);

            //return stringPaquete;
        }

        //var paquete = procesarPaquete()

        //alert(paquete);

        /*function pasarDatosPaquetes(var paquete) {

        }*/

    </script>
    <title><?php echo PAGE_TITLE ?></title>

    <?php getTopIncludes(RUTA_INCLUDE ) ?>
</head>

<body id="page-top">

<?php getNavbar() ?>

<div id="wrapper">

    <?php getSidebar() ?>

    <div id="content-wrapper">

        <div class="container-fluid">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Cotizaciones</li>
                    <!--<li class="breadcrumb-item active" aria-current="page">Nombre de la sección</li>-->
                    <li class="breadcrumb-item active" aria-current="page">Nueva cotización</li>
                </ol>
            </nav>

            <!-- Mensajes de exito y error
            <div class="alert alert-success" role="alert">
                <i class="fas fa-check"></i> Mensaje de éxito
            </div>

            <div class="alert alert-danger" role="alert">
                <i class="fas fa-exclamation-triangle"></i> Mensaje de error
            </div>

            -->

        </div>

        <!-- /.container-fluid -->

        <div class="container">
            <!--<div class="row mb-5">
                <div class="col">
                    <button type="button" class="btn btn-success">Guardar</button>
                </div>
                <div class="col text-right">
                    <button type="button" class="btn btn-link">Cancelar</button>
                </div>
            </div>-->

            <form action="procesarNuevaCotizacion.php" method="post" enctype="multipart/form-data">
                <h2 class="font-weight-normal">Servicio</h2>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputServicio">Tipo de servicio</label>
                        <!--<input type="email" class="form-control" id="inputEmail4">-->
                        <select id="inputServicio" class="custom-select mr-sm-4" name="tipoServicio">
                            <option selected value="default">Seleccione una opción...</option>
                            <option value="Urgente">Urgente</option>
                            <option value="Dia siguiente">Dia siguiente</option>
                            <option value="Estandar">Estandar (terrestre)</option>
                        </select>
                    </div>

                    <div class="form-check-inline">
                        <input class="form-check-input" type="checkbox" id="asegurar" name="asegurar" value="S">
                        <label class="form-check-label" for="asegurar">
                            Asegurar el envío<!--<a class="-underline" href="#">Mas información</a>-->
                        </label>
                    </div>
                </div>

                <div class="row mb-4 justify-content-between">
                    <div class="col-4">
                        <h2 class="font-weight-normal">Paquete(s)</h2>
                    </div>


                    <div class="col-4">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#staticBackdrop">Agregar paquete</button>
                    </div>
                    <!--<div class="col text-right">-->

                </div>

                <input type="hidden" id="datosPaquetes" name="datosPaquetes" value="">

                <table id="paquetes" class="table table-sm table-hover">
                    <caption>Paquetes agregados</caption>
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Embalaje</th>
                        <th scope="col">Peso</th>
                        <th scope="col">Dimensiones</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Accion</th>
                    </tr>
                    </thead>
                    <tbody>
                    <!--<tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>25614 MX ...</td>
                        <td>@mdo</td>
                        <td>@mdo</td>
                        <td>@mdo</td>
                        <td>@mdo</td>
                    </tr>-->
                    </tbody>
                </table>

                <!--

                <div class="row mb-2 justify-content-md-around">
                    <div>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#staticBackdrop">Agregar paquete</button>
                    </div>
                    <\!--<div class="col text-right">--\>
                    <div>
                        <button type="button" class="btn btn-info">Ver paquetes</button>
                    </div>
                </div>

                -->

                <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Agregar paquete</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="inputProducto">¿Qué desea enviar?</label>
                                        <select id="inputProducto" class="custom-select mr-sm-6">
                                            <option selected></option>
                                            <option value="paquete">Paquete</option>
                                            <option value="documento">Documento</option>
                                        </select>
                                    </div>

                                    <div class="form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="embalaje" value="embalaje">
                                        <label class="form-check-label" for="embalaje">
                                            Requiero embalaje <a class="-underline" href="#">Mas información</a>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label for="inputPeso">Peso</label>
                                        <input type="text" class="form-control" id="inputPeso">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputLargo">Largo</label>
                                        <input type="text" class="form-control" id="inputLargo">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputAncho">Ancho</label>
                                        <input type="text" class="form-control" id="inputAncho">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputAlto">Alto</label>
                                        <input type="text" class="form-control" id="inputAlto">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label for="inputCantidad">Cantidad</label>
                                        <input type="text" class="form-control" id="inputCantidad">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="descProducto">Descripción del producto (en caso de requerir empaque)</label>
                                    <textarea class="form-control col-md-10" id="descProducto" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-success" onclick="procesarPaquete()">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>

                <h2 class="font-weight-normal">Origen</h2>

                <div class="form-row">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="origen" id="sucursal" value="S">
                        <label class="form-check-label" for="sucursal">Dejaré en sucursal</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="origen" id="recoleccion" value="S">
                        <label class="form-check-label" for="recoleccion">Requiero recolección</label>
                    </div>

                    <table class="table table-sm table-hover">
                        <caption>Direcciones registradas</caption>
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">CP</th>
                            <th scope="col">Dirección</th>
                            <th scope="col">Referencia</th>
                            <th scope="col">Seleccionar</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $numeroDireccion = 1;

                        foreach($direcciones as $tablaDireccion) {
                            $id = $tablaDireccion['id'];
                            $cp = $tablaDireccion['cp'];
                            $calle = $tablaDireccion['calle'];
                            $numExt = $tablaDireccion['num_exterior'];
                            //$numInt = $d['num_int'];
                            $entreCalles = $tablaDireccion['entre_calles'];
                            $referencia = $tablaDireccion['referencia'];
                            $direccion = $calle . " numero " . $numExt . " entre calles " . $entreCalles; //agregar colonia al principio
                            ?>
                            <tr>
                                <th scope="row"><?php echo $numeroDireccion; ?></th>
                                <td><?php echo $cp; ?></td>
                                <td><?php echo $direccion; ?></td>
                                <td><?php echo $referencia; ?></td>
                                <td><label><input type="radio" name="direcOrigen" value="<?php echo $id; ?>"></label></td>
                            </tr>

                            <?php

                            $numeroDireccion++;
                        }
                        ?>

                        </tbody>
                    </table>
                </div>

                <h2 class="font-weight-normal">Destino</h2>

                <table class="table table-sm table-hover">
                    <caption>Direcciones registradas</caption>
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">CP</th>
                        <th scope="col">Dirección</th>
                        <th scope="col">Referencia</th>
                        <th scope="col">Seleccionar</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $numeroDireccion = 1;

                    foreach($direcciones as $tablaDireccion) {
                        $id = $tablaDireccion['id'];
                        $cp = $tablaDireccion['cp'];
                        $calle = $tablaDireccion['calle'];
                        $numExt = $tablaDireccion['num_exterior'];
                        //$numInt = $d['num_int'];
                        $entreCalles = $tablaDireccion['entre_calles'];
                        $referencia = $tablaDireccion['referencia'];
                        $direccion = $calle . " numero " . $numExt . " entre calles " . $entreCalles; //agregar colonia al principio
                        ?>
                        <tr>
                            <th scope="row"><?php echo $numeroDireccion; ?></th>
                            <td><?php echo $cp; ?></td>
                            <td><?php echo $direccion; ?></td>
                            <td><?php echo $referencia; ?></td>
                            <td><label><input type="radio" name="direcDestino" value="<?php echo $id; ?>"></label></td>
                        </tr>

                        <?php

                        $numeroDireccion++;
                    }
                    ?>

                    </tbody>
                </table>

                    <!-- Tabla responsiva
                    <div class="table-responsive mb-3">
                        <table class="table table-bordered dataTable">
                            <caption>Direcciones registradas</caption>
                            <thead>
                            <tr>
                                <th>Direccion</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Direccion</th>
                                <th>Acciones</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            <tr>
                                <td>Tiger Nixon</td>
                                <td><a href="#" class="btn btn-link btn-sm btn-sm">Editar</a> <a href="#" class="btn btn-link btn-sm">Eliminar</a></td>
                            </tr>
                            <tr>
                                <td>Garrett Winters</td>
                                <td><a href="#" class="btn btn-link btn-sm">Editar</a> <a href="#" class="btn btn-link btn-sm">Eliminar</a></td>
                            </tr>
                            <tr>
                                <td>Ashton Cox</td>
                                <td><a href="#" class="btn btn-link btn-sm">Editar</a> <a href="#" class="btn btn-link btn-sm">Eliminar</a></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                -->

                <div class="form-row mb-4">
                    <div class="form-check-inline">
                        <input class="form-check-input" type="checkbox" id="factura" name="factura" value="S">
                        <label class="form-check-label" for="factura">
                            Requiero factura<!--<a class="-underline" href="#">Mas información</a>-->
                        </label>
                    </div>
                </div>



                <div class="form-row mb-4 justify-content-around">
                    <div class="row">
                        <button type="button" class="btn btn-danger">Cancelar cotización</button>
                    </div>
                    <div class="row">
                        <button type="submit" class="btn btn-primary">Realizar cotización</button>
                    </div>
                </div>

            </form>
        </div>
        <!-- /.container -->

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

<?php getBottomIncudes( RUTA_INCLUDE ) ?>
</body>

</html>
