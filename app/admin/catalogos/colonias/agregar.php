<?php
require_once '../../../../config/global.php';
include '../../../../config/db.php';

define('RUTA_INCLUDE', '../../../../'); //ajustar a necesidad
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
                    <li class="breadcrumb-item">Colonia</li>
                    <li class="breadcrumb-item active" aria-current="page">Nueva colonia</li>
                </ol>
            </nav>

        </div>

        <!-- /.container-fluid -->

        <div class="container">

            <form id="form" method="post" autocomplete="off" action="agregarProceso.php">

                <div class="row mb-5">
                    <div class="col">
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                    <div class="col text-right">
                        <a href="index.php" type="button" class="btn btn-link">Cancelar</a>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6 col-sm-12">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre">
                        <div class="invalid-feedback">Ingresa el nombre</div>
                    </div>
                    <div class="form-group col-md-6 col-sm-2">
                        <label for="cp">Código Postal</label>
                        <input type="text" class="form-control" id="cp" name="cp">
                        <div class="invalid-feedback">Ingresa el código postal</div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-12">
                        <label for="asentamiento">Asentamiento</label>
                        <select name="sentamiento" id="asentamiento" class="custom-select">
                            <option value="" disabled selected>Seleccione una opción</option>
                            <option value="Colonia">Colonia</option>
                            <option value="Gran usuario">Gran usuario</option>
                            <option value="Fraccionamiento">Fraccionamiento</option>
                            <option value="Condominio">Condominio</option>
                            <option value="Barrio">Barrio</option>
                            <option value="Unidad habitacional">Unidad habitacional</option>
                            <option value="Zona comercial">Zona comercial</option>
                            <option value="Residencial">Residencial</option>
                            <option value="Ranchería">Ranchería</option>
                            <option value="Equipamiento">Equipamiento</option>
                            <option value="Parque industrial">Parque industrial</option>
                            <option value="Congregación">Congragación</option>
                            <option value="Poblado comunal">Poblado comunal</option>
                            <option value="Pueblo">Pueblo</option>
                            <option value="Ejido">Ejido</option>
                            <option value="Granja">Granja</option>
                            <option value="Zona federal">Zona federal</option>
                            <option value="Zona industrial">Zona industrial</option>
                            <option value="Aereopuerto">Aereopuerto</option>
                            <option value="Hacienda">Hacienda</option>
                            <option value="Estación">Estación</option>
                            <option value="Conjunto habitacional">Conjunto habitacional</option>
                            <option value="Ampliación">Amplicación</option>
                            <option value="Ciudad">Ciudad</option>
                            <option value="Rancho">Rancho</option>
                        </select>
                        <div class="invalid-feedback">Selecciona un tipo de asentamiento</div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-12 col-md-6">
                        <label for="estado">Estado</label>
                        <select class="custom-select" name="estado" id="estado">
                            <option value="" disabled selected>Selecciona una opción</option>
                            <?php
                            $query =    "SELECT * FROM `pakmail`.estados";

                            if ($result = mysqli_query($conexion, $query)) {
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <option value="<?php echo $row["id"]; ?>"><?php echo $row["estado"]; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                        <div class="invalid-feedback">Selecciona un estado</div>
                    </div>
                    <div class="form-group col-sm-12 col-md-6">
                        <label for="municipio">Municipio</label>
                        <select name="municipio" id="municipio" class="custom-select"></select>
                        <div class="invalid-feedback">Selecciona un municipio</div>
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

<script>

    document.getElementById("estado").addEventListener("change",function(){
        fetch('getMunicipios.php?id_estado=' + this.value)
            .then(response => response.json())
            .then(municipios => {
                const select = document.getElementById("municipio");
                select.innerHTML = '<option value="" disabled selected>Selecciona una opción</option>';
                for( const municipio of municipios ){
                    const option = document.createElement("option");
                    option.value = municipio.id;
                    option.innerText = municipio.municipio;
                    select.appendChild(option);
                }
            });
    });

    document.getElementById("form").addEventListener("submit",function (e){

        let vacios = 0;
        const elements = document.querySelectorAll("input,select");
        for( const element of elements ){
            if( element.value.trim() === "" ){
                vacios++;
                element.classList.add("is-invalid");
            }else{
                element.classList.remove("is-invalid");
            }
        }

        if( vacios > 0 )
            e.preventDefault();

    });

</script>

</body>

</html>
