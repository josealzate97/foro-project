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
            <input type="text" name="user_name" class="form-control user-name only-text" placeholder="Ingresa tu nombre" maxlength="50">
        </div>
        <!-- Apellido -->
        <div class="col-lg-6 col-md-6 col-sm-6">
            <label><b>Apellido</b> *</label>
            <input type="text" name="user_lastname" class="form-control user-lastname only-text" placeholder="Ingresa tu apellido" maxlength="50">
        </div>
    </div>

    <!-- Correo -->
    <div class="col-lg-12 col-md-12 col-sm-12 auth-email-div">
        <label><b>Correo</b> *</label>
        <input type="email" name="user_email" class="form-control user-email" placeholder="Ingresa tu correo" maxlength="100">
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 pt-2 pb-2 flex"> 
        <!-- Usuario -->
        <div class="col-lg-6 col-md-6 col-sm-6">
            <label><b>Usuario</b> *</label>
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
            <a href="{{ route('login') }}" class="text-center ">¿Ya tienes cuenta? Accede aqui!</a>
        </center>
    </div>   
@endsection

@section('footer') @endsection


@section('js')

    // funcion que permite solo texto en un CAMPOS
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

    // Funcion que permite solo numeros-letras en el username

    // Funcion encargada de validar un correo existente

    // Funcion encargada de validar un username existente

    // validacion del formulario
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
                    console.log(data.code)
                    switch (data.code) {
                        case 200:
                            swal({
                                icon: 'success',
                                text: 'Usuario registrado correctamente'
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