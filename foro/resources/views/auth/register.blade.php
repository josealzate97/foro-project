@extends('layouts.auth-layout')

@section('nav')
    <a href="{{ route('login') }}" class="text-center btn btn-warning auth-nav-btn mt-3"><b>INICIAR SESION</b></a>
@endsection

@section('content')
    <div class="col-lg-12 col-md-12 col-sm-12 pt-4 pb-2">   
        <h2 class="text-center">¡CREA UNA CUENTA!</h2>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 pt-2 pb-2 flex"> 
        <!-- Nombre -->
        <div class="col-lg-6 col-md-6 col-sm-6">
            <label><b>Nombre</b> *</label>
            <input type="text" name="user_name" class="form-control user-name only-text" placeholder="Ingresa tu nombre" maxlength="25">
        </div>
        <!-- Apellido -->
        <div class="col-lg-6 col-md-6 col-sm-6">
            <label><b>Apellido</b> *</label>
            <input type="text" name="user_lastname" class="form-control user-lastname only-text" placeholder="Ingresa tu apellido" maxlength="25">
        </div>
    </div>

    <!-- Correo -->
    <div class="col-lg-12 col-md-12 col-sm-12 auth-email-div">
        <label><b>Correo</b> *</label>&nbsp;&nbsp;<i class="email-validate-ok fa fa-check"></i>
        <input type="email" name="user_email" class="form-control user-email" placeholder="Ingresa tu correo" maxlength="100">
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 pt-2 pb-2 flex"> 
        <!-- Usuario -->
        <div class="col-lg-6 col-md-6 col-sm-6">
            <label><b>Usuario</b> *</label>&nbsp;&nbsp;
            <input type="text" name="user_alias" class="form-control user-alias" placeholder="Ingresa tu usuario" maxlength="20">
        </div>
        <!-- Contraseña -->
        <div class="col-lg-6 col-md-6 col-sm-6">
            <label><b>Contraseña</b> *</label>
            <input type="password" name="user_password" class="form-control user-password" placeholder="Ingresa tu contraseña" maxlength="15">
        </div>
    </div>

    <!-- Boton crear cuenta -->
    <div class="col-lg-12 col-md-12 col-sm-12">
        <center>    
            <a href="#" class="text-center btn btn-warning btn-lg save-data"><b>REGISTRAR CUENTA</b></a>
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

    // Validacion de campos de texto 
    $('.only-text').keydown(function(e) { 
        if (e.shiftKey || e.ctrlKey || e.altKey) {
            e.preventDefault();
        } else {
            var key = e.keyCode;
            if (!((key == 8) || (key == 32) || (key == 46) || (key >= 35 && key <= 40) || (key >= 65 && key <= 90))) {
                e.preventDefault();
            }
        }    
    });

    // Funcion encargada de validar el email del lado cliente
    function validateEmail (email) 
    {
        var re = /\S+@\S+\.\S+/;
        return re.test(email);
    }

    // Funcion encargada de validar usuario por username
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
                                text: 'Este correo ya se encuentra registrado',
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

    // Funcion encargada de validar usuario por email
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
        }
    });

    // validacion y envio de datos del formulario
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

@endsection
