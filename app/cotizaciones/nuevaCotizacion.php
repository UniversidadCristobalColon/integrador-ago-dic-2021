<?php
require_once '../../config/global.php';

define('RUTA_INCLUDE', '../../'); //ajustar a necesidad
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
                    <li class="breadcrumb-item">Sección</li>
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

            <form>
                <h2 class="font-weight-normal">Servicio</h2>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputServicio">Tipo de servicio</label>
                        <!--<input type="email" class="form-control" id="inputEmail4">-->
                        <select id="inputServicio" class="custom-select mr-sm-4">
                            <option selected>Seleccione una opción...</option>
                            <option value="urgente">Urgente</option>
                            <option value="diaSig">Dia siguiente</option>
                            <option value="estandar">Estandar (terrestre)</option>
                        </select>
                    </div>

                    <div class="form-check-inline">
                        <input class="form-check-input" type="checkbox" id="gridCheck">
                        <label class="form-check-label" for="gridCheck">
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
                <!--
                    <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputProducto">¿Qué desea enviar?</label>
                        <input type="email" class="form-control" id="inputEmail4">
                        <select class="custom-select mr-sm-4">
                            <option selected>Seleccione una opción...</option>
                            <option value="paquete">Paquete</option>
                            <option value="documento">Documento</option>
                        </select>
                    </div>

                    <div class="form-check-inline">
                        <input class="form-check-input" type="checkbox" id="gridCheck">
                        <label class="form-check-label" for="gridCheck">
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
                <div class="form-group">
                    <label for="descProducto">Descripción del producto (en caso de requerir empaque)</label>
                    <textarea class="form-control col-md-6" id="descProducto" rows="3"></textarea>
                </div>
-->

                <table class="table table-sm table-hover">
                    <caption>Paquetes agregados | Total de paquetes: 3 </caption>
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
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>25614 MX ...</td>
                        <td>@mdo</td>
                        <td>@mdo</td>
                        <td>@mdo</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>47896 ARG ...</td>
                        <td>@fat</td>
                        <td>@fat</td>
                        <td>@fat</td>
                        <td>@fat</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Larry the Bird</td>
                        <td>89541 ITA ...</td>
                        <td>@twitter</td>
                        <td>@twitter</td>
                        <td>@twitter</td>
                        <td>@twitter</td>
                    </tr>
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
                                        <input class="form-check-input" type="checkbox" id="gridCheck">
                                        <label class="form-check-label" for="gridCheck">
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
                            <button type="button" class="btn btn-success">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>






                <!--<h2 class="font-weight-normal">Información del destinatario</h2>-->
                <!--<div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Email</label>
                        <input type="email" class="form-control" id="inputEmail4">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Password</label>
                        <input type="password" class="form-control" id="inputPassword4">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputAddress">Address</label>
                    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                </div>
                <div class="form-group">
                    <label for="inputAddress2">Address 2</label>
                    <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputCity">City</label>
                        <input type="text" class="form-control" id="inputCity">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputState">State</label>
                        <select id="inputState" class="form-control">
                            <option selected>Choose...</option>
                            <option>...</option>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputZip">Zip</label>
                        <input type="text" class="form-control" id="inputZip">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck">
                        <label class="form-check-label" for="gridCheck">
                            Check me out
                        </label>
                    </div>
                </div>
                -->

                <h2 class="font-weight-normal">Destinatario</h2>

                <table class="table table-sm table-hover">
                    <caption>Direcciones agregadas</caption>
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Remitente</th>
                        <th scope="col">Direccion</th>
                        <th scope="col">Seleccionar</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>25614 MX ...</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>47896 ARG ...</td>
                        <td>@fat</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Larry the Bird</td>
                        <td>89541 ITA ...</td>
                        <td>@twitter</td>
                    </tr>
                    </tbody>
                </table>

                <div class="form-row mb-4">
                    <div class="form-check-inline">
                        <input class="form-check-input" type="checkbox" id="gridCheck">
                        <label class="form-check-label" for="gridCheck">
                            Requiero factura<!--<a class="-underline" href="#">Mas información</a>-->
                        </label>
                    </div>
                </div>

                <div class="row mb-4 justify-content-around">
                    <div>
                        <button type="button" class="btn btn-danger">Cancelar cotizacion</button>
                    </div>
                    <div>
                        <button type="button" class="btn btn-primary">Realizar cotizacion</button>
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
