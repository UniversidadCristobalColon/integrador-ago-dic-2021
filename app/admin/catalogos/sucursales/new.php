<?php
require_once '../../../../config/global.php';
require_once './functions.php';

if( isset($_POST) && count($_POST) ){
    if( !isset($_POST["id"]) ){
        if( add_sucursal($_POST) )
            header('location: index.php?alert=true&message=Sucursal agregada exitosamente');
        else
            header('location: index.php?alert=false&message=Hubo un error agregando la sucursal, inténtelo más tarde');
    }else {
        if( update_sucursal($_POST) )
            header('location: index.php?alert=true&message=Sucursal editada exitosamente');
        else
            header('location: index.php?alert=false&message=Hubo un error editando la sucursal, inténtelo más tarde');
    }
}else{

    define('RUTA_INCLUDE', '../../../../'); //ajustar a necesidad

    $sucursal = null;
    if( isset($_GET["id"]) && !empty($_GET["id"]) ){
        $sucursal = get_sucursal($_GET["id"]);
        if( count($sucursal) == 0 )
            header('location: new.php');
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
                        <li class="breadcrumb-item">Catalogos</li>
                        <li class="breadcrumb-item"><a href="./index.php">Sucursales</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php if($sucursal) echo "Editar"; else echo "Nueva"; ?></li>
                    </ol>
                </nav>

            </div>

            <!-- /.container-fluid -->

            <div class="container">

                <form id="form" action="new.php" method="post">
                    <div class="row mb-5">
                        <div class="col">
                            <button type="submit" class="btn btn-success"><?php if($sucursal) echo "Editar"; else echo "Guardar"; ?></button>
                        </div>
                        <div class="col text-right">
                            <a href="./index.php" type="button" class="btn btn-link">Cancelar</a>
                        </div>
                    </div>

                    <?php
                    if( $sucursal ){
                        ?>
                            <input name="id" id="id" type="hidden" value="<?php echo $sucursal["id"]; ?>">
                        <?php
                    }
                    ?>

                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input name="nombre" type="text" class="form-control" id="nombre" placeholder="Nombre de la sucursal"
                        <?php
                        if( $sucursal )
                            echo " value='". $sucursal["sucursal"] ."' ";
                        ?>
                        >
                        <div class="invalid-feedback">Ingrese el nombre de la sucursal</div>
                    </div>
                    <div class="form-group">
                        <label for="direccion">Dirección</label>
                        <input name="direccion" type="text" class="form-control" id="direccion" placeholder="Dirección de la sucursal"
                            <?php
                            if( $sucursal )
                                echo " value='". $sucursal["domicilio"] ."' ";
                            ?>
                        >
                        <div class="invalid-feedback">Ingrese la dirección de la sucursal</div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-12 col-md-6">
                            <label for="estado">Estado</label>
                            <select name="estado" id="estado" class="form-control custom-select">
                                <option value="" disabled selected>Seleccionar estado</option>
                                <?php
                                foreach ( get_estados() as $estado ){
                                    ?>
                                    <option value="<?php echo $estado["id"]; ?>"><?php echo $estado["estado"]; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <div class="invalid-feedback">Seleccione un estado</div>
                        </div>
                        <div class="form-group col-sm-12 col-md-6">
                            <label for="municipio">Municipio</label>
                            <select name="municipio" id="municipio" class="form-control custom-select"></select>
                            <div class="invalid-feedback">Seleccione un municipio</div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-12 col-md-6">
                            <label for="localidad">Localidad</label>
                            <select name="colonia" id="localidad" class="form-control custom-select"></select>
                            <div class="invalid-feedback">Seleccione una localidad</div>
                        </div>
                        <div class="form-group col-sm-12 col-md-6">
                            <label for="colonia">Colonia</label>
                            <select name="colonia" id="colonia" class="form-control custom-select"></select>
                            <div class="invalid-feedback">Seleccione una colonia</div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-12 col-md-4">
                            <label for="cp">Código Postal</label>
                            <input readonly name="cp" type="text" class="form-control" id="cp">
                            <div class="invalid-feedback">Seleccione una colonia</div>
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
        const sucursal = <?php if ($sucursal) echo json_encode($sucursal); else echo "null";  ?>;
        const municipios = <?php echo json_encode(get_municipios()); ?>;
        const localidades = <?php echo json_encode(get_localidades()); ?>;
        const colonias = <?php echo json_encode(get_colonias()); ?>;
    </script>
    <script src="./new.js"></script>

    </body>

    </html>
<?php

}