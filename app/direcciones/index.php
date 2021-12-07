<?php

require_once '../../config/global.php';
require_once '../../config/db.php';

@session_start();
$cliente = $_SESSION['id_usuario'];
//$cliente = 23;

$sql = "SELECT d.id, alias, calle, d.cp, entre_calles, num_exterior, num_interior, referencia, d.status, c.colonia, l.localidad, m.municipio, e.estado
from direcciones d
left join `colonias` c on d.id_colonia = c.id
left join localidades l on c.id_localidad = l.id 
left join municipios m on c.id_municipio = m.id 
left join estados e on m.id_estado = e.id
where id_cliente = $cliente and d.status = 'A' ";

$resultado = mysqli_query($conexion, $sql);

$direcciones = array();

if( $resultado ){
    while($fila = mysqli_fetch_assoc($resultado)){
        $direcciones[] = $fila;
    }
}

define('RUTA_INCLUDE', '../../'); //ajustar a necesidad

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <?php getTopIncludes( RUTA_INCLUDE )?>
</head>

<style>
    .dropdown-toggle::after {
        display: none !important;
    }
    /*.boton {*/
    /*    background-color: white;*/
    /*    border: none;*/
    /*}*/
</style>

<body id = "page-top">

<?php getNavbar( RUTA_INCLUDE )?>

<div id = "wrapper">

    <?php getSidebar( RUTA_INCLUDE )?>

    <div id="content-wrapper">

        <div class="container-fluid">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Mis direcciones</li>
                </ol>
            </nav>

            <div>

                <div class = "w-100 d-flex">

                <button id = "nueva_direccion" type="button" class="btn btn-primary my-2 ml-auto mr-2">
                    <i class="fas fa-plus"></i>
                    Nueva
                </button>

                </div>

                <ul class="my-3 d-flex flex-wrap" style="padding-left: 0 !important;">
                    <?php
                    $contador = 0;
                    if ( count($direcciones) == '0' ){
                     ?>
                        <div class="alert alert-warning mt-3 mr-4 w-100" role="alert">
                            <i class="fas fa-exclamation-triangle"></i> No hay direcciones
                        </div>
                <?php
                }
                    foreach ($direcciones as $p){
                    ?>
                    <li class="list-group-item d-flex align-items-center m-2" style = "width: 31.8%">
                        <div class = "d-flex flex-column">
                            <div><b><?php echo $p['alias'] ?></b></div>
                            <div><?php echo $p['calle'] ?></div>
                            <div><?php echo $p['colonia'] ?></div>
                            <div><?php echo $p['cp'] ?></div>
                            <div><?php echo $p['municipio'] ?>, <?php echo $p['estado'] ?></div>
                        </div>
                        <div class="ml-auto btn-group">
                            <button type="button" class="dropdown-toggle btn btn-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <div class="dropdown-menu">
                                <div class = "d-flex flex-column">
                                    <a style="cursor: pointer" onclick="editarDireccion(<?php echo $p['id'] ?>)" class = "dropdown-item">Editar</a>
                                    <a style="cursor: pointer" onclick="eliminaDireccion(<?php echo $p['id'] ?>)" class = "dropdown-item">Eliminar</a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php } ?>

                </ul>

            </div>


        </div>

        <?php getFooter( RUTA_INCLUDE )?>

    </div>

</div>

<?php getModalLogout( RUTA_INCLUDE )?>
<?php getBottomIncudes( RUTA_INCLUDE )?>

<div id = "modal_nueva_direccion" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nueva dirección</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action = "javascript:validateForm()" id = "formDireccion">
                <div class = "form-group">
                    <label for="alias">Alias de la dirección</label>
                    <input type="text" class="form-control" id="alias" placeholder="Ej. Casa, Oficina" required>
                </div>

                <div class = "form-group">
                    <label for="direccion">Calle</label>
                    <input type="text" class="form-control" id="calle" placeholder="Ej. Paseo de las Americas 257" required>
                </div>

                <div class = "form-group">
                    <label for="cp">Código postal</label>
                    <div class = "d-flex flex-row">
                    <input type="text" class="form-control w-50 mr-3" id="cp" placeholder="Ej. 91807" required>
                    <button type = "button" class = "btn btn-light w-50 ml-3" id = "validacp" onclick="validaCP()">Validar código postal</button>

                    </div>
                    <div id = "exito" class="alert alert-success mt-3" style="display: none" role="alert">
                        <i class="fas fa-check"></i> Código postal válido
                    </div>

                    <div id = "error" class="alert alert-danger mt-3" style="display: none" role="alert">
                        <i class="fas fa-exclamation-triangle"></i> Favor de introducir un código postal válido
                    </div>
                </div>

                <div id = "codigovalido" style = "display: none">

                <div class = "form-group">
                    <label for="estado">Estado/Provincia/Región</label>
                    <input type="text" class="form-control" id="estado" readonly>
                </div>

                <div class = "form-group">
                    <label for="municipio">Municipio</label>
                    <input type="text" class="form-control" id="municipio" readonly>
                </div>

                    <div class = "form-group">
                        <label for="localidad">Localidad</label>
                        <input type="text" class="form-control" id="localidad" readonly>
                    </div>

                <div class = "form-group">
                    <label for="colonia">Colonia</label>
                    <select id = "colonia" class="form-control" aria-label="Default select example">
                    </select>
                </div>

                </div>

                <div class = "form-group">
                    <div class = "d-flex flex-row">
                        <div class = "pr-2 w-50">
                            <label for="numext">No. exterior</label>
                            <input type="text" class="form-control" id="numext" required>
                        </div>
                        <div class = "pr-2 w-50">
                            <label for="numint">No. interior</label>
                            <input type="text" class="form-control" id="numint">
                        </div>

                    </div>

                </div>

                <div class = "form-group">
                    <label for="entrecalles">Entre calles</label>
                    <input type="text" class="form-control" id="entrecalles" required>
                </div>

                <div class = "form-group">
                    <label for="referencia">Referencia</label>
                    <input type="text" class="form-control" id="referencia" required>
                </div>

                    <input type="hidden" id = "id_direccion">

<!--                <div class = "form-group">-->
<!--                    <label for=""></label>-->
<!--                    <input type="text" class="form-control" id="">-->
<!--                </div>-->
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </form>

        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#nueva_direccion').on('click', function(){
            $('#modal_nueva_direccion').modal('show');
        })

        $('#validacp').on('click', function(){

            console.log('validando cp');

        })

        $('#modal_nueva_direccion').on('hidden.bs.modal', function (e) {
            $('#id_direccion').val('');
        })

    })



    function validaCP( colonia ){
        var cp = $('#cp').val();

        console.log('Esta es la colonia en valida CP '+colonia)

        $.ajax({
            url: "codpos.php",
            method: "POST",
            success: function (response){
                if(response.length==0){
                    $('#error').show();
                    $('#exito').hide();
                    $('#codigovalido').hide();
                    $('#estado').removeAttr('required');
                    $('#municipio').removeAttr('required');
                    $('#localidad').removeAttr('required');
                    $('#colonia').removeAttr('required');
                } else {
                    $('#exito').show();
                    $('#error').hide();
                    $('#codigovalido').show();
                    $('#municipio').val(response[0].municipio);
                    $('#estado').val(response[0].estado);
                    if (response[0].localidad)
                    $('#localidad').val(response[0].localidad);
                    else $('#localidad').val('Sin localidad');
                    $('#colonia').empty();
                    $('#colonia').append('<option value = "">Seleccione una colonia</option>')
                    for(var i = 0 ; i < response.length ; i++){
                        $('#colonia').append(`
                            <option ${ colonia && colonia == response[i].id? 'selected': '' } value="${response[i].id}">${response[i].colonia}</option>
                            `)
                    }
                    $('#estado').prop('required',true);
                    $('#municipio').prop('required',true);
                    $('#localidad').prop('required',true);
                    $('#colonia').prop('required',true);

                }
                console.log(response);
            },
            data: {'cp': cp, 'metodo': 'cp'},
            dataType: "json"
        })
    }

    function validateForm(){

        $('#validacp').trigger('click');

        console.log($('#error').is('hidden'));

        if(!$('#error').is('hidden')){
            var formData = new FormData();

            formData.append('alias', $('#alias').val());
            formData.append('calle', $('#calle').val());
            formData.append('numext', $('#numext').val())
            if($('#numint').val())
                formData.append('numint', $('#numint').val())
            else formData.append('numint', '');
            if($('#entrecalles').val())
            formData.append('entrecalles', $('#entrecalles').val())
            else formData.append('entrecalles', '');
            if($('#referencia').val())
            formData.append('referencia', $('#referencia').val())
            else formData.append('referencia', '');
            formData.append('cp', $('#cp').val())
            formData.append('colonia', $('#colonia').val());
            // formData.append('localidad', $('#localidad').val());
            formData.append('metodo', 'saveedit');
            formData.append('cliente', '<?php echo $cliente ?>');

            id = $('#id_direccion').val();

            if( $('#id_direccion').val() && $('#id_direccion').val() != '' ){
                formData.append('id', $('#id_direccion').val());
            }

            jQuery.ajax({
                url: "codpos.php",
                method: "POST",
                success: function (response){
                    if(response == 'Direccion creada con exito' || response == 'Direccion actualizada con exito'){
                        $('#modal_nueva_direccion').modal('hide');
                        alert('Dirección guardada correctamente.');
                        window.location.href = 'index.php';
                    }
                },
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json"
            })
        }


    }

    function editarDireccion( id ){
        $.ajax({
            url: "codpos.php",
            method: "POST",
            success: function (response){
                if(response.length==0){
                    alert('Error al acceder a la dirección');
                } else {
                    console.log(response);

                    $('#alias').val(response[0].alias);
                    $('#calle').val(response[0].calle);
                    $('#numext').val(response[0].num_exterior);
                    $('#numint').val(response[0].num_interior);
                    $('#entrecalles').val(response[0].entre_calles);
                    $('#referencia').val(response[0].referencia);
                    $('#id_direccion').val(response[0].id);

                    $('#cp').val(response[0].cp);

                    validaCP(response[0].id_colonia)

                    $('#modal_nueva_direccion').modal('show');


                }
            },
            data: {'id': id, 'metodo': 'muestradireccion'},
            dataType: "json"
        })
    }

    function eliminaDireccion( id ){
        if (confirm('¿Está seguro de que desea eliminar esta dirección?')) {
            $.ajax({
                url: "codpos.php",
                method: "POST",
                success: function (response) {
                    console.log(response);

                    if (response == 'Direccion eliminada correctamente'){
                        alert('Dirección eliminada correctamente.');
                        window.location.href = 'index.php';
                    } else {
                        alert('Ocurrió un error');
                    }

                        },
                data: {'id': id, 'metodo': 'eliminadireccion'},
                dataType: "json"
            })
        }
    }
</script>


</body>

</html>