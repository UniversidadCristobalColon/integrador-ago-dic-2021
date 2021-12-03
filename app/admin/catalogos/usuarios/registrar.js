window.onload = function(){

    const   emailRegex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i,
            inputCorreo = $("#correo"),
            inputPassword = $("#password"),
            inputPasswrod2 = $("#password2");

    $("#registrar").submit(function (e){

        const   validoCelular = validaTelefono("celular"),
                validoTelefono = validaTelefono("telefono"),
                validPassword = validaPassword();

        let validosInputsText = 0;
        $.each( $("#registrar input[type='text']"), function (i,e){
            const input = $(e);
            if( !validaInput(input) )
                validosInputsText++;
        } );

        console.log(validoCelular,validoTelefono,validosInputsText,validPassword);
        if( !(validoCelular && validoTelefono && validosInputsText === 0 && validPassword) )
            e.preventDefault();

    });

    $("#registrar input[type='text']").keyup(function(e){
        const input = $(this);
        validaInput(input);
    });

    function validaPassword(){
        console.log(inputPassword.val().trim().length);
        if(inputPassword.val().trim().length < 7){
            inputPassword.addClass("is-invalid");
        }else{
            inputPassword.removeClass("is-invalid");
            if( inputPassword.val().trim() !== inputPasswrod2.val().trim() ){
                inputPasswrod2.addClass("is-invalid");
            }else{
                inputPasswrod2.removeClass("is-invalid");
                return true;
            }
        }
        return false;
    }

    function validaInput(input){
        if( input.val().trim() === "" ) {
            input.addClass("is-invalid");
            return false;
        }else {
            input.removeClass("is-invalid");
            return true;
        }
    }

    function validaTelefono(id){
        const input = $("#"+id);
        if( input.val().trim().length !== 10 ) {
            input.addClass("is-invalid");
            return false;
        }else {
            input.removeClass("is-invalid");
            return true;
        }
    }

    $("#registrar input[type='tel']").keyup(function(e){
        validaTelefono(this.id);
    });

    function validaCorreo(){
        if (!emailRegex.test(inputCorreo.val())) {
            inputCorreo.addClass("is-invalid");
        } else {
            inputCorreo.removeClass("is-invalid");
        }
    }

    function validaDigito(evt){
        const code = (evt.which) ? evt.which : evt.keyCode;
        return code>=48 && code<=57;
    }

    $("#telefono,#celular").keypress(function(evt){
        if( this.value.length>=10 ) return false;
        return validaDigito(evt);
    })

    inputCorreo.keyup(function(e){
        validaCorreo();
    });

    $("#registrar input[type='password']").keyup(function(){
        validaPassword();
    });

}