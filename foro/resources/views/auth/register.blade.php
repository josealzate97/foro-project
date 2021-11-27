@extends('layouts.auth-layout')

@section('nav')
    <a href="{{ route('login') }}" class="text-center btn btn-login auth-nav-btn mt-1"><b>INICIAR SESION</b></a>
@endsection

@section('content')
    <div class="col-lg-12 col-md-12 col-sm-12 pt-4 pb-2">   
        <h2 class="text-center">¡CREA UNA CUENTA!</h2>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 pt-2 pb-2 flex"> 
        <!-- Nombre -->
        <div class="col-lg-6 col-md-6 col-sm-6">
            <label><b>Nombre</b> *</label>
            <input type="text" name="user_name" class="form-control user-name" placeholder="Ingresa tu nombre" maxlength="25" onkeypress="onlyText(event)">
        </div>
        <!-- Apellido -->
        <div class="col-lg-6 col-md-6 col-sm-6">
            <label><b>Apellido</b> *</label>
            <input type="text" name="user_lastname" class="form-control user-lastname" placeholder="Ingresa tu apellido" maxlength="25" onkeypress="onlyText(event)">
        </div>
    </div>

    <!-- Correo -->
    <div class="col-lg-12 col-md-12 col-sm-12 auth-email-div">
        <label><b>Correo</b> *</label>
        &nbsp;&nbsp;<i class="email-validate-ok fa fa-check"></i>
        <input type="email" name="user_email" class="form-control user-email" placeholder="Ingresa tu correo" maxlength="100">
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 pt-2 pb-2 flex"> 
        <!-- Usuario -->
        <div class="col-lg-6 col-md-6 col-sm-6">
            <label><b>Usuario</b> *</label>
            &nbsp;&nbsp;<i class="username-validate-ok fa fa-check"></i>
            <input type="text" name="user_alias" class="form-control user-alias" placeholder="Ingresa tu usuario" maxlength="20" onkeypress="allowAlphaNumericSpace(event)">
        </div>
        <!-- Contraseña -->
        <div class="col-lg-6 col-md-6 col-sm-6">
            <label><b>Contraseña</b> *</label>
            <input type="password" name="user_password" class="form-control user-password" placeholder="Ingresa tu contraseña" maxlength="15" onkeypress="allowAlphaNumericSpace(event)">
        </div>
    </div>

    <!-- Boton crear cuenta -->
    <div class="col-lg-12 col-md-12 col-sm-12">
        <center>    
            <a href="#" class="text-center btn btn-regist-action btn-lg save-data"><b>REGISTRAR CUENTA</b></a>
        </center>
    </div>

    <!-- Seccion retorno -->
    <div class="col-lg-12 col-md-12 col-sm-12">
        <center><br>   
            <a href="{{ route('login') }}" class="text-center">¿Ya tienes cuenta? Accede aqui!</a>
        </center>
    </div>   
@endsection

@section('footer') @endsection


@section('js')

    // Script al cargar el documento
    $( document ).ready(function() {
        $('.email-validate-ok').hide();
        $('.username-validate-ok').hide();
    });

    // Funcion encargada de validar usuarios existentes por username
    $(".user-email").on('change', function(e) {

        // Datos a validar
        var emailToValidate = $(this).val();
        var isValidEmail = validateEmail(emailToValidate);
        
        if (emailToValidate != '' && isValidEmail == true) {

            $('.save-data').removeClass('disabled');

            // Datos armados para validar
            var data = {
                "_token" : "{{ csrf_token() }}",
                'data' : emailToValidate,
                'validate-type' : 1
            }

            // Peticion ajax 
            $.ajax({
                type: "POST",
                url: "{{ route('validate-user') }}",
                data: data,
                dataType: "json",
                encode: true,
            }).done(function (response) {
                if (response) {
                    switch (response.code) {
                        case 200:
                            
                            $('.email-validate-ok').hide();
                            $('.save-data').addClass('disabled');

                            swal({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Este correo ya se encuentra registrado'
                            }).then(function() {
                                $('.user-email').val('');
                            });

                            break;
                        case 202:
                            
                            $('.save-data').removeClass('disabled');
                            $('.email-validate-ok').show(550);

                            break;
                        case 404:
                            swal({
                                icon: 'error',
                                text: 'Se ha presentado un error en en la validacion'
                            });
                            break;    
                    }
                }
            });
        } else {
            swal({ 
                icon: 'error',
                text: 'El email ingresado no es valido', 
            }).then(function() {
                $('.email-validate-ok').hide();
                $('.user-email').val('');
                $('.save-data').addClass('disabled');
            });;
        }
        
    });

    // Funcion encargada de validar usuarios existentes por email
    $(".user-alias").on('change', function(e) {
        // Datos a validar
        var dataToValidate = $(this).val();

        if (dataToValidate != '') {
            // Datos armados para validar
            var data = {
                "_token" : "{{ csrf_token() }}",
                'data' : dataToValidate,
                'validate-type' : 2
            }

            $.ajax({
                type: "POST",
                url: "{{ route('validate-user') }}",
                data: data,
                dataType: "json",
                encode: true,
            }).done(function (response) {
                if (response) {
                    switch (response.code) {
                        case 200:
                            $('.username-validate-ok').hide();
                            $('.save-data').addClass('disabled');

                            swal({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Este usuario ya se encuentra registrado',
                            }).then(function() {
                                $('.user-alias').val('');
                            });

                            break;
                        case 202:
                            $('.save-data').removeClass('disabled');
                            $('.username-validate-ok').show(550);

                            break;
                        case 404:
                            swal({
                                icon: 'error',
                                text: 'Se ha presentado un error en en la validacion'
                            });

                            break;
                    }
                }        
            });
        }
    });

    // validacion de campos y envio de datos del formulario
    $(".save-data").on('click', function() {

        var name = $('.user-name').val();
        var lastname = $('.user-lastname').val();
        var email = $('.user-email').val();
        var alias = $('.user-alias').val();
        var password = $('.user-password').val();

        if (name == '' || lastname == '' || email == '' || alias == '' || password =='') {
            swal({ 
                icon: 'error',
                text: 'FORMULARIO INVALIDO O CAMPOS VACIOS', 
            });
        } else {
            var data = {
                "_token" : "{{ csrf_token() }}",
                "name" : name,
                "lastname" : lastname,
                "email" : email,
                "alias" : alias,
                "password" : password
            }

            $.ajax({
                type: "POST",
                url: "{{ route('register-user') }}",
                data: data,
                dataType: "json",
                encode: true,
            }).done(function (data) {
                if (data) {
                    
                    switch (data.code) {
                        case 200:
                            swal({
                                icon: 'success',
                                text: 'Usuario registrado correctamente'
                            }).then(function() {
                                window.location = "{{ route('login') }}";
                            });
                            break;
                        case 404:
                            swal({
                                icon: 'error',
                                text: 'Se ha presentado un error en el registro'
                            });
                            break;    
                    }
                }
            });
        }
    });

    // Validacion de campos de texto 
    function onlyText(e) 
    { 
        var regex = new RegExp("^[a-zA-Z ]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);

        if (!regex.test(key)) {
            event.preventDefault();
            return false;
        }
    }

    // Funcion encargada de validar el email del lado cliente
    function validateEmail (email) 
    {
        var re = /\S+@\S+\.\S+/;
        return re.test(email);
    }

    // Funcion encargada de validar username solo con minusculas y numeros
    function allowAlphaNumericSpace(e) 
    {
        var code = ('charCode' in e) ? e.charCode : e.keyCode;

        if (!(code == 32) && // space
          !(code > 47 && code < 58) && // numeric (0-9)
          !(code > 96 && code < 123)) { // lower alpha (a-z)
          e.preventDefault();
        }
    }

@endsection
