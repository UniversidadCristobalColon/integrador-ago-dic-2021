<?php

require_once '../../config/global.php';

define('RUTA_INCLUDE', '../../'); //ajustar a necesidad

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <?php getTopIncludes( RUTA_INCLUDE )?>
</head>

<body id = "page-top">

<?php getNavbar( RUTA_INCLUDE )?>

<div id = "wrapper">

    <?php getSidebar( RUTA_INCLUDE )?>

    <div id="content-wrapper">

        <div class="container-fluid w-50 p-4">

            <h1>Agregar nueva dirección</h1>
            <div class = "form-group">
                <label for="nombre_completo">Nombre Completo</label>
                <input type="text" class="form-control" id="nombre_completo" placeholder="Ej. Raúl Galindo Alfonsin">
            </div>

            <div class = "form-group">
                <label for="direccion">Dirección de la calle</label>
                <input type="text" class="form-control" id="direccion" placeholder="Ej. Paseo de las Americas 257">
            </div>

            <div class = "form-group">
                <label for="cp">Código postal</label>
                <div class = "d-flex flex-row">
                    <input type="text" class="form-control w-50 mr-3" id="cp" placeholder="Ej. 91807">
                    <button type = "button" class = "btn btn-light w-50 ml-3" id = "validacp">Validar código postal</button>
                </div>
            </div>

            <div id = "codigovalido" class = "d-none">

                <div class = "form-group">
                    <label for="estado">Estado/Provincia/Región</label>
                    <input type="text" class="form-control" id="estado">
                </div>

                <div class = "form-group">
                    <label for="municipio">Municipio</label>
                    <input type="text" class="form-control" id="municipio">
                </div>

                <div class = "form-group">
                    <label for="colonia">Colonia</label>
                    <select id = "colonia" class="form-control" aria-label="Default select example">
                        <option selected>El Morro</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>

            </div>

            <div class = "form-group">
                <div class = "d-flex flex-row">
                    <div class = "pr-2 w-50">
                        <label for="numext">No. exterior</label>
                        <input type="text" class="form-control" id="numext">
                    </div>
                    <div class = "pr-2 w-50">
                        <label for="numint">No. interior</label>
                        <input type="text" class="form-control" id="numint">
                    </div>

                </div>

            </div>

            <div class = "form-group">
                <label for="entrecalles">Entre calles</label>
                <input type="text" class="form-control" id="entrecalles">
            </div>

            <div class = "form-group">
                <label for="referencia">Referencia</label>
                <input type="text" class="form-control" id="referencia">
            </div>


        </div>

        <?php getFooter( RUTA_INCLUDE )?>

    </div>

</div>

<?php getModalLogout( RUTA_INCLUDE )?>
<?php getBottomIncudes( RUTA_INCLUDE )?>




                <!--                <div class = "form-group">-->
                <!--                    <label for=""></label>-->
                <!--                    <input type="text" class="form-control" id="">-->
                <!--                </div>-->



</body>

</html>
