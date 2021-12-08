<?php
//@session_start();

//$status = session_status();

/*
if($status == PHP_SESSION_NONE) {
    //echo "no sesion<br>";
    @session_start();
} else if($status == PHP_SESSION_ACTIVE) {
    echo "se inicio?<br>";
}*/

//echo $_SESSION['id_cliente'];

$idCliente = 0;

if(array_key_exists('idCliente', $_GET)) {
    $idCliente = $_GET['idCliente'];
    echo $idCliente . "<br>";
}

require_once '../../../config/global.php';
require_once '../../../config/db.php';

define('RUTA_INCLUDE', '../../../'); //ajustar a necesidad

function obtenerDirecciones($conexion, $idCliente) {

    //$idCliente = $_SESSION['id_cliente'];

    /*echo "idcliente<br>";
    echo $idCliente;
    echo "<br>";
    echo "<br>";*/

    if($idCliente != 0) {
        $selectDirecciones = "
        SELECT 
               direcciones.id, 
               direcciones.cp, 
               direcciones.calle, 
               direcciones.num_exterior, 
               direcciones.num_interior, 
               direcciones.entre_calles, 
               direcciones.referencia, 
               direcciones.alias, 
               direcciones.id_cliente, 
               clientes.nombre, 
               clientes.apellidos,
               clientes.email,
               clientes.celular,
               clientes.telefono,
               colonias.colonia,
               municipios.municipio,
               estados.estado
        FROM `direcciones`
        INNER JOIN `clientes` ON direcciones.id_cliente = clientes.id
        INNER JOIN `usuarios` ON clientes.id = usuarios.id_cliente
        INNER JOIN `colonias` ON direcciones.id_colonia = colonias.id
        INNER JOIN `municipios` ON colonias.id_municipio = municipios.id
        INNER JOIN `estados` ON municipios.id_estado = estados.id
        WHERE direcciones.id_cliente = $idCliente AND usuarios.id_perfil = 2 AND direcciones.alias NOT LIKE '%ucursal';";

        $resultado = mysqli_query($conexion, $selectDirecciones);

        if($resultado) {

            $hayDirecciones = false;

            while( $fila = mysqli_fetch_assoc($resultado)) {
                $hayDirecciones = true;
                $direcciones[] = $fila;
            }

            if($hayDirecciones) {
                return $direcciones;
            } else {
                return false;
            }

        } else {
            //echo "error<br>";
            echo mysqli_error($conexion);

        }

    } /*else {

        $selectDirecciones = "
        SELECT 
               direcciones.id, 
               direcciones.cp, 
               direcciones.calle, 
               direcciones.num_exterior, 
               direcciones.num_interior, 
               direcciones.entre_calles, 
               direcciones.referencia, 
               direcciones.alias, 
               direcciones.id_cliente, 
               clientes.nombre, 
               clientes.apellidos,
               clientes.email,
               clientes.celular,
               clientes.telefono
        FROM `direcciones`
        INNER JOIN `clientes` ON direcciones.id_cliente = clientes.id
        INNER JOIN `usuarios` ON clientes.id = usuarios.id_cliente
        WHERE usuarios.id_perfil = 2 AND direcciones.alias NOT LIKE '%ucursal';";
    }*/
        /*FROM `direcciones`
            INNER JOIN `clientes` ON clientes.id = direcciones.id_cliente 
        WHERE direcciones.alias <> 'sucursal';\";*/

    /*
     SELECT direcciones.id, direcciones.cp, direcciones.calle, direcciones.referencia, direcciones.alias, direcciones.id_cliente, clientes.id, usuarios.id_cliente, clientes.nombre, clientes.apellidos, usuarios.id, usuarios.id_perfil

    AQUI

    FROM `direcciones`
INNER JOIN `clientes` ON direcciones.id_cliente = clientes.id
INNER JOIN `usuarios` ON clientes.id = usuarios.id_cliente
WHERE usuarios.id_perfil = 2 AND direcciones.alias NOT LIKE '%ucursal';
     */

    return false;

}

//echo"direcciones<br>";
$direcciones = obtenerDirecciones($conexion, $idCliente);

function obtenerClientes($conexion) {

    //$idCliente = $_SESSION['id_cliente'];

    /*echo "idcliente<br>";
    echo $idCliente;
    echo "<br>";
    echo "<br>";*/

    $selectClientes = "
        SELECT c.id,
               c.nombre,
               c.apellidos,
               c.celular,
               c.telefono,
               c.email
               FROM `clientes` AS c
               INNER JOIN `usuarios` AS u ON c.id = u.id_cliente
               WHERE u.id_perfil = 2;";

    $resultado = mysqli_query($conexion, $selectClientes);

    if($resultado) {

        $hayClientes = false;

        while( $fila = mysqli_fetch_assoc($resultado)) {
            $hayClientes = true;
            $clientes[] = $fila;
        }

        if($hayClientes) {
            return $clientes;
        } else {
            return false;
        }



    } else {
        //echo "error<br>";
        echo mysqli_error($conexion);

    }

    return false;

}

//echo"direcciones<br>";
$clientes = obtenerClientes($conexion);

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



        /*$(document).ready(function(){
            $("input[name='origen']").change(function(){
                if($(this).val() == 'S') {
                    $("#paquetes").addClass("d-none");
                } else if($(this).val == 'R') {
                    $("#paquetes").removeClass("d-none");
                }
            });
        });*/

        $(document).ready(function(){
            $('.form-control-chosen').chosen();
        });

            $('.form-control-chosen').chosen({
            allow_single_deselect: true,
            width: '100%'
        });
            $('.form-control-chosen-required').chosen({
            allow_single_deselect: false,
            width: '100%'
        });
            $('.form-control-chosen-search-threshold-100').chosen({
            allow_single_deselect: true,
            disable_search_threshold: 100,
            width: '100%'
        });
            $('.form-control-chosen-optgroup').chosen({
            width: '100%'
        });

        var idCliente = 0;
        var numPaquete = 0;
        var pesoRealTotal = 0;
        var pesoVolumetricoTotal = 0;
        var pesoFacturar = 0;
        var totalesPesosReales = [];
        var totalesPesosVolum = [];

        function procesarPaquete() {

            if (validarCamposPaquete()) {

                ++numPaquete;

                var tipoProducto = $("#inputProducto option:selected").val();

                var embalaje = 'N';

                if ($("#embalaje").is(":checked")) {
                    embalaje = 'S';
                }

                var peso = $("#inputPeso").val();
                var largo = $("#inputLargo").val();
                var ancho = $("#inputAncho").val();
                var alto = $("#inputAlto").val();

                var largoString = Number.parseFloat(largo).toFixed(2);
                var anchoString = Number.parseFloat(ancho).toFixed(2);
                var altoString = Number.parseFloat(alto).toFixed(2);


                var cantidad = $("#inputCantidad").val();
                var descProducto = $("#descProducto").val();


                $("#embalaje").prop("checked", false);
                $("#inputPeso").val("");
                $("#inputLargo").val("");
                $("#inputAncho").val("");
                $("#inputAlto").val("");
                $("#inputCantidad").val("");
                $("#descProducto").val("");


                var pesoVolumetricoInd = (largo * ancho * alto) / 5000;
                var pesoTotalPaquete = peso * cantidad;
                var pesoVolTotalPaquete = pesoVolumetricoInd * cantidad;

                totalesPesosReales.push(pesoTotalPaquete);
                //console.log(totalesPesosReales);

                totalesPesosVolum.push(pesoVolTotalPaquete);
                //console.log(totalesPesosVolum);

                var pesoString = Number.parseFloat(peso).toFixed(2);
                var pesoVolIndString = Number.parseFloat(pesoVolumetricoInd).toFixed(4);

                pesoVolumetricoTotal += pesoVolumetricoInd * cantidad;
                pesoRealTotal += pesoTotalPaquete;

                var stringPaquete = tipoProducto + "," + embalaje + "," + peso + "," + largo + "," + ancho + "," + alto + "," + cantidad + "," + descProducto;

                var renglonPaquetes = "" +
                    "<tr>" +
                    //"<th scope='row'>"+ numPaquete + "</th>" +
                    "<td>" + tipoProducto + "</td>" +
                    "<td>" + embalaje + "</td>" +
                    //"<td>" + peso + "</td>" +
                    "<td>Peso real: " + pesoString + " kg<br>Peso vol: " + pesoVolIndString + " kg</td>" +
                    "<td>" + largoString + "x" + anchoString + "x" + altoString + "</td>" +
                    "<td>" + cantidad + "</td>" +
                    "<td>" + descProducto + "</td>" +
                    //"<td><!--<a href='#' class='btn btn-link btn-sm btn-sm'>Editar</a>--> <a href='#' class='btn btn-link btn-sm' onclick='eliminarPaquete('\"" + numPaquete + "\"')'>Eliminar</a></td>" +
                    "<td><a href='#paquetes' class='btn btn-link btn-sm' onclick='eliminarPaquete(" + numPaquete + ")'>Eliminar</a></td>" +
                    //"<td><input type="hidden" value=\"" + peso + "\" name="paquete[]"></td>" +
                    //"<td><input type='hidden' value='" + peso + "' + name='paquete[]'></td>" +
                    "<td><input type='hidden' value='" + stringPaquete + "' + name='paquete[]'></td>" +
                    "</tr>";

                //alert(stringPaquete);

                //$("#paquetes tr:last").append(renglonPaquetes);
                //$("#paquetes tbody tr:last").append(renglonPaquetes);
                var numFilasTabla = $("#paquetes tbody tr").length;

                if (numFilasTabla == 0) {
                    $("#paquetes tbody").append(renglonPaquetes);
                } else if (numFilasTabla > 0) {
                    $("#paquetes tr:last").after(renglonPaquetes);
                }


                //alert(stringPaquete);

                $("#datosPaquetes").val(stringPaquete);

                if (pesoRealTotal >= pesoVolumetricoTotal) {
                    pesoFacturar = pesoRealTotal;
                } else if (pesoRealTotal <= pesoVolumetricoTotal) {
                    pesoFacturar = pesoVolumetricoTotal;
                }

                //alert(pesoFacturar);

                var stringPesos = "Total peso real: " + pesoRealTotal.toFixed(2) + " | Total peso volumétrico: " + pesoVolumetricoTotal.toFixed(2) + " | Peso a facturar: " + pesoFacturar.toFixed(2);

                $("#paquetes").find("caption").text(stringPesos);
                //alert(stringPesos);

                $("#pesoRealTotal").val(pesoRealTotal);
                $("#pesoTotalVol").val(pesoVolumetricoTotal);
                $("#pesoAFacturar").val(pesoFacturar);
            } else {
                alert("Verifique que los datos de entrada sean correctos");
            }

            //return stringPaquete;
        }

        function validarCamposPaquete() {
            $valido = true;

            var producto = $("#inputProducto").val();

            if(producto == "default") {
                //console.log("producto default");
                $valido = false;
            }

            var largo = $("#inputLargo").val();
            var ancho = $("#inputAncho").val();
            var alto = $("#inputAlto").val();
            var peso = $("#inputPeso").val();

            var cantidad = $("#inputCantidad").val();

            /*console.log("largo1");
            console.log(largo);

            largo.replace(/[^0-9]/g, '');
            ancho.replace(/[^0-9]/g, '');
            alto.replace(/[^0-9]/g, '');
            peso.replace(/[^0-9]/g, '');

            console.log("largo2");
            console.log(largo);
            console.log("ancho");
            console.log(ancho);
            console.log("alto");
            console.log(alto);
            console.log("peso");
            console.log(peso);

            */

            largo = parseFloat(largo);
            ancho = parseFloat(ancho);
            alto = parseFloat(alto);
            peso = parseFloat(peso);

            /*$("#inputLargo").val(largo);
            $("#inputAncho").val(ancho);
            $("#inputAlto").val(alto);
            $("#inputPeso").val(peso);*/

            /*if(!isNaN(largo)) {
                alert("largo es numero");
            } else {
                alert("largo no es numero");
            }*/

            /*if(!(isNaN(largo)) && !(isNaN(ancho)) && !(isNaN(alto)) && !(isNaN(peso))) {
                console.log("pase el 1er if");
                if(largo > 0 && ancho > 0 && alto > 0 && peso > 0) {
                    alert("vientos");
                } else {
                    alert("alguno de los valores no es mayor a 0");
                }
            } else {
                alert("Falta un valor o alguno de los valores en las dimensiones no es numero");
            }*/

            if((isNaN(largo)) || (isNaN(ancho)) || (isNaN(alto)) || (isNaN(peso))) {
                //alert("alguno no es numero");
                $valido = false;
            } else if(largo < 0 || ancho < 0 || alto < 0 || peso < 0) {
                //alert("alguno es menor a 0");
                $valido = false;
            }

            return $valido;
        }

        function eliminarPaquete(numFila) {
            console.log("Numero de fila");
            console.log(numFila);

            var indicePaquete = numFila - 1;
            //alert(indicePaquete);

            $("#paquetes tbody").find("tr").eq(indicePaquete).remove();
            //console.log("Numero de filas");
            $("#paquetes tbody").children("tr").each(function(indice){
                fila = indice + 1;
                //console.log(fila);
                //$(this).find("td").eq(6).find("a").attr("href", "eliminarPaquete(" + indice + ")");
                $(this).find("td").eq(6).find("a").attr("href", "#paquetes");
                $(this).find("td").eq(6).find("a").attr("onclick", "eliminarPaquete(" + fila + ")");
                //console.log($(this).find("td").length);
            });

            pesoEliminado = totalesPesosReales.splice(indicePaquete, 1);
            pesoVolEliminado = totalesPesosVolum.splice(indicePaquete, 1);

            //console.log(pesoEliminado[0]);
            //console.log(pesoVolEliminado[0]);

            pesoRealTotal -= pesoEliminado;
            pesoVolumetricoTotal -= pesoVolEliminado;

            //pesoRealTotal -= totalesPesosReales[indicePaquete];
            //pesoVolumetricoTotal -= totalesPesosVolum[indicePaquete];

            //totalesPesosReales.splice(indicePaquete, 1);
            //totalesPesosVolum.splice(indicePaquete, 1);

            if(pesoRealTotal < 0 || pesoVolumetricoTotal < 0) {
                pesoRealTotal = 0;
                pesoVolumetricoTotal = 0;
            }

            if(pesoRealTotal >= pesoVolumetricoTotal) {
                pesoFacturar = pesoRealTotal;
            } else if(pesoRealTotal <= pesoVolumetricoTotal){
                pesoFacturar = pesoVolumetricoTotal;
            }




            var stringPesos = "Total peso real: " + pesoRealTotal.toFixed(2) + " | Total peso volumétrico: " + pesoVolumetricoTotal.toFixed(2) + " | Peso a facturar: " + pesoFacturar.toFixed(2);
            $("#paquetes").find("caption").text(stringPesos);

            $("#pesoRealTotal").val(pesoRealTotal);
            $("#pesoTotalVol").val(pesoVolumetricoTotal);
            $("#pesoAFacturar").val(pesoFacturar);

            numPaquete--;
        }

        function validarPaqueteYDirecciones() {

            //console.log("numPaquete");
            //console.log(numPaquete);

            if(numPaquete == 0) {
                //console.log("hoal desde validaar");
                $("#formulario").submit(function(e){
                    e.preventDefault();
                });

            }



        }

        function esconderTablaOrigen() {
            $("#tablaOrigen").addClass("d-none");
            //console.log("hola");
        }

        function mostrarTablaOrigen() {
            $("#tablaOrigen").removeClass("d-none");
            console.log("hoal2");
        }

        //var paquete = procesarPaquete()

        //alert(paquete);

        /*function pasarDatosPaquetes(var paquete) {

        }*/

        function obtenerCliente() {
            //console.log($("input[name='cliente']:checked").val());
            idCliente = $("input[name='cliente']:checked").val();
            console.log("hola");
            console.log(idCliente);
            //var url = "nuevaCotizacionUsuario.php?idCliente=" + idCliente;
            var urlRaul = "../direcciones/index.php?idCliente=" + idCliente;
            $("#direc").attr("href", urlRaul);

            var urlRecargar = "new.php?idCliente=" + idCliente;

            $(window).attr('location',urlRecargar);
        }

        function recargarDirecciones() {
            //Obtener valor radio seleccionado
            $idCliente = $("input[name='cliente']:checked").val();

            console.log("hola");
            console.log($idCliente)

            var url= "new.php?idCliente=";
            //$(window).attr('location','https://tutorialdeep.com/knowhow/get-current-page-url-jquery/');

        }

    </script>

    <title><?php echo PAGE_TITLE ?></title>

    <?php getTopIncludes(RUTA_INCLUDE ) ?>

    <style>
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button { /* Safari, Chrome, Edge y Opera */
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance:textfield; /* Firefox */
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

            <form action="process.php" method="post" enctype="multipart/form-data" id="formulario">

                <div class="form-row">
                    <h2 class="font-weight-normal">Clientes</h2>
                </div>

                <div class="table-responsive mb-3">



                    <table class="table table-bordered dataTable">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Contacto</th>
                            <th>Seleccionar</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Nombre</th>
                            <th>Contacto</th>
                            <th>Seleccionar</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        <?php
                        foreach($clientes as $tablaClientes) {
                            $id = $tablaClientes['id'];
                            $nombre = $tablaClientes['nombre'];
                            $apellidos = $tablaClientes['apellidos'];

                            $celular = "N/A";

                            if(array_key_exists('celular', $tablaClientes)) {
                                $celular = $tablaClientes['celular'];

                                if(empty($celular)) {
                                    $celular = "N/A";
                                }
                            }

                            $telefono = "N/A";

                            if(array_key_exists('telefono', $tablaClientes)) {
                                $telefono = $tablaClientes['telefono'];

                                if(empty($telefono)) {
                                    $telefono = "N/A";
                                }
                            }

                            $email = "N/A";

                            if(array_key_exists('email', $tablaClientes)) {
                                $email = $tablaClientes['email'];

                                if(empty($email)) {
                                    $email = "N/A";
                                }
                            }

                            $contacto = "Cel: " . $celular . "<br>Tel: " . $telefono . "<br>Email: " . $email;

                        ?>
                        <tr>
                            <th scope="row"><?php echo $nombre . " " . $apellidos; ?></th>
                            <td><?php echo $contacto; ?></td>
                            <td><label><input type="radio" name="cliente" value="<?php echo $id; ?>" onclick="obtenerCliente()" required></label></td>
                        </tr>
                        <?php
                        }
                        ?>

                        </tbody>
                    </table>
                </div>

                <div class="form-row">
                    <select id="single" class="form-control form-control-chosen" data-placeholder="Please select...">
                        <option></option>
                        <option>Option One</option>
                        <option>Option Two</option>
                        <option>Option Three</option>
                    </select>
                </div>


                <div class="form-row">
                    <h2 class="font-weight-normal">Servicio</h2>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputServicio">Tipo de servicio</label>
                        <!--<input type="email" class="form-control" id="inputEmail4">-->
                        <select id="inputServicio" class="custom-select mr-sm-4" name="tipoServicio" required>
                            <option selected value="default">Seleccione una opción...</option>
                            <option value="Urgente">Urgente</option>
                            <option value="Dia siguiente">Dia siguiente</option>
                            <option value="Estandar">Estandar (terrestre)</option>
                        </select>
                    </div>

                    <div class="form-check-inline">
                        <input class="form-check-input" type="checkbox" id="asegurar" name="asegurar" value="S">
                        <label class="form-check-label" for="asegurar">
                            Asegurar el envío (opcional)<!--<a class="-underline" href="#">Mas información</a>-->
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

                <input type="hidden" id="pesoRealTotal" name="pesoRealTotal" value="">
                <input type="hidden" id="pesoTotalVol" name="pesoTotalVol" value="">
                <input type="hidden" id="pesoAFacturar" name="pesoAFacturar" value="">
                <input type="hidden" id="datosPaquetes" name="datosPaquetes" value="">

                <table id="paquetes" class="table table-sm table-hover">
                    <!--<caption>Paquetes agregados</caption>-->
                    <caption></caption>
                    <thead>
                    <tr>
                        <!--<th scope="col">#</th>-->
                        <th scope="col">Tipo</th>
                        <th scope="col">Embalaje</th>
                        <th scope="col">Peso (individual)</th>
                        <th scope="col">Dimensiones</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Descripción</th>
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
                                                <option value="default" selected></option>
                                                <option value="paquete">Paquete</option>
                                                <option value="documento">Documento</option>
                                            </select>
                                        </div>

                                        <!--<div class="form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="embalaje" value="embalaje">
                                            <label class="form-check-label" for="embalaje">
                                                Requiero embalaje (opcional)<\!--<a class="-underline" href="#"> Mas información</a>--\>
                                            </label>
                                        </div>-->
                                    </div>

                                    <div class="form-row">
                                        <div class="form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="embalaje" value="embalaje">
                                            <label class="form-check-label" for="embalaje">
                                                Requiero embalaje (opcional)<!--<a class="-underline" href="#"> Mas información</a>-->
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-row mt-4">
                                        <div class="form-group col-md-2">
                                            <label for="inputLargo">Largo</label>
                                            <input type="number" class="form-control" id="inputLargo" placeholder="cm">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="inputAncho">Ancho</label>
                                            <input type="number" class="form-control" id="inputAncho" placeholder="cm">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="inputAlto">Alto</label>
                                            <input type="number" class="form-control" id="inputAlto" placeholder="cm">
                                        </div>
                                        <!--<div class="form-group col-md-4">
                                            <label for="inputPesoVol">Peso volumétrico</label>
                                            <input type="text" class="form-control" id="inputPesoVol" readonly>
                                        </div>-->
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="inputPeso">Peso individual</label>
                                            <input type="number" class="form-control" id="inputPeso" placeholder="kg">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="inputCantidad">Cantidad</label>
                                            <input type="text" class="form-control" id="inputCantidad">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="descProducto">Descripción del producto</label>
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

                <!--<div class="form-row">
                    <h2 class="font-weight-normal">Destino</h2>
                </div>-->

                <div class="row mb-4 justify-content-between">
                    <div class="col-4">
                        <h2 class="font-weight-normal">Destino</h2>
                    </div>


                    <div class="col-4">
                        <!--<a class="btn btn-success" href="nuevaCotizacionUsuario.php?">Crear direccion</a>-->
                        <a class="btn btn-success" id="direc" href="#top">Crear direccion</a>
                    </div>
                    <!--<div class="col text-right">-->

                </div>

                <div class="table-responsive mb-3">

                    <table class="table table-bordered dataTable">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Contacto</th>
                            <th>Direccion</th>
                            <th>Referencia</th>
                            <th>Alias</th>
                            <th>Seleccionar</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Nombre</th>
                            <th>Contacto</th>
                            <th>Direccion</th>
                            <th>Referencia</th>
                            <th>Alias</th>
                            <th>Seleccionar</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        <?php

                        if($direcciones != false) {

                        foreach($direcciones as $tablaDireccion) {
                            $idDireccion = $tablaDireccion['id'];
                            $cp = $tablaDireccion['cp'];
                            $calle = $tablaDireccion['calle'];

                            $numExt = "N/A";

                            if(array_key_exists('num_exterior', $tablaDireccion)) {
                                $numExt = $tablaDireccion['num_exterior'];

                                if(empty($numExt)) {
                                    $numExt = "N/A";
                                }
                            }

                            $numInt = "N/A";

                            if(array_key_exists('num_interior', $tablaDireccion)) {
                                $numInt = $tablaDireccion['num_interior'];

                                if(empty($numInt)) {
                                    $numInt = "N/A";
                                }
                            }

                            //$numInt = $tablaDireccion['num_int'];

                            $entreCalles = $tablaDireccion['entre_calles'];
                            $referencia = $tablaDireccion['referencia'];
                            $alias = $tablaDireccion['alias'];
                            $colonia = $tablaDireccion['colonia'];
                            $municipio = $tablaDireccion['municipio'];
                            $estado = $tablaDireccion['estado'];

                            $direccion = $calle . ", numero ext: " . $numExt . " y/o numero int: " . $numInt . ",  entre calles " . $entreCalles. ", CP: " . $cp . "<br>Colonia: " . $colonia . "<br>Municipio: " . $municipio . "<br>Estado: " .$estado;

                            $idCliente = $tablaDireccion['id_cliente'];
                            $nombre = $tablaDireccion['nombre'];
                            $apellidos = $tablaDireccion['apellidos'];
                            $nombreCliente = $nombre . " " . $apellidos;

                            $email = $tablaDireccion['email'];
                            $celular = $tablaDireccion['celular'];
                            $telefono = $tablaDireccion['telefono'];
                            //$celYTel = $celular . "/" . $telefono;

                            $contacto = "Cel: " . $celular . "<br>Tel: " . $telefono . "<br>Email: " . $email;



                            ?>
                            <tr>
                                <th scope="row"><?php echo $nombreCliente; ?></th>
                                <td><?php echo $contacto; ?></td>
                                <!--<td><?php //echo $email; ?></td>-->
                                <td><?php echo $direccion; ?></td>
                                <td><?php echo $referencia; ?></td>
                                <td><?php echo $alias; ?></td>
                                <td><label><input type="radio" name="destino" value="<?php echo $idDireccion; ?>" required></label></td>
                            </tr>

                            <?php
                        }
                        }
                        ?>
                    </table>
                </div>

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
                            Requiere factura (opcional)<!--<a class="-underline" href="#">Mas información</a>-->
                        </label>
                    </div>
                </div>



                <div class="form-row mb-4 justify-content-around">
                    <div class="row">
                        <a class="btn btn-danger" href="index.php">Cancelar cotización</a>
                    </div>
                    <div class="row">
                        <button type="submit" class="btn btn-primary" id="botonSubmit" onclick="validarPaqueteYDirecciones()">Realizar cotización</button>
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