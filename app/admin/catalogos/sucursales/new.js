window.onload = async function() {

    let colonias = [];

    const get_municipios_estado = async id_estado => {
        return fetch('getMunicipios.php?id_estado=' + id_estado)
            .then(response => response.json());
    };

    const get_localidades_municipio = id_municipio => {
        return fetch('getLocalidades.php?id_municipio=' + id_municipio)
            .then(response => response.json());
    };

    const get_colonias_municipio = id_municipio => {
        return fetch('getColonias.php?id_municipio=' + id_municipio)
            .then(response => response.json());
    }

    const get_colonia = id_colonia => {
        for( const colonia of colonias )
            if( colonia.id.toString() === id_colonia )
                return colonia;
    };

    const vacia_selects = (ids_selects) => {
        for( const id of ids_selects )
            document.getElementById(id).innerHTML = '';
    };

    const llena_select = (id_select,values, placeholder) => {
        const select = document.getElementById(id_select);
        select.innerHTML = '<option value="" disabled selected>'+ placeholder +'</option>';
        for( const value of values ){
            const option = document.createElement("option");
            option.value = value.id;
            option.innerText = value[id_select];
            select.appendChild(option)
        }
    }

    document.getElementById("estado").addEventListener("change",async function(e){
        const municipios = await get_municipios_estado(this.value);
        llena_select("municipio",municipios, "Seleccione un municipio");
        vacia_selects(["localidad","colonia"]);
    });

    document.getElementById("municipio").addEventListener("change",async function(e){
        const localidades = await get_localidades_municipio(this.value);
        llena_select("localidad",localidades, "Seleccione una localidad");
        colonias = await get_colonias_municipio(this.value);
        llena_select("colonia",colonias, "Seleccione una localidad");
    })

    document.getElementById("localidad").addEventListener("change",function(e){

    })

    document.getElementById("colonia").addEventListener("change",function(e){
        const colonia = get_colonia(this.value);
        const inputCP = document.getElementById("cp");
        inputCP.value = colonia.cp;
        valid(inputCP);
    })

    const inputsAndSelects = document.getElementById("form").querySelectorAll("input,select");

    const valid = inputOrSelect => {
        if( inputOrSelect.value.trim() === "" ) {
            inputOrSelect.classList.add("is-invalid");
            return false;
        }else{
            inputOrSelect.classList.remove("is-invalid");
            return true;
        }
    };

    document.getElementById("form").addEventListener("submit",function (e){

        let errores = 0;
        for( const inputOrSelect of inputsAndSelects )
            if(!valid(inputOrSelect))
                errores++;

        if( errores > 0 )
            e.preventDefault();
    });

    for( const inputOrSelect of inputsAndSelects ){
        inputOrSelect.addEventListener("keyup",function (e) {
            valid(this)
        });

        inputOrSelect.addEventListener("change",function (e) {
            valid(this)
        });
    }

    if( typeof sucursal !== "undefined" && sucursal ){
        document.getElementById("estado").value = sucursal.id_estado;
        const municipios = await get_municipios_estado(sucursal.id_estado);
        llena_select("municipio",municipios,"Seleccione un municipio");
        document.getElementById("municipio").value = sucursal.id_municipio;
        const localidades = await get_localidades_municipio(sucursal.id_municipio);
        llena_select("localidad",localidades,"Selecciona una localidad");
        document.getElementById("localidad").value = sucursal.id_localidad;
        colonias = await get_colonias_municipio(sucursal.id_municipio);
        llena_select("colonia",colonias,"Seleccione una colonia");
        document.getElementById("colonia").value = sucursal.id_colonia;
        document.getElementById("cp").value = sucursal.cp;
    }

};

