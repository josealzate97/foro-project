@extends('layouts.auth-layout')


@section('nav')
    <a href="{{ route('view-register') }}" class="text-center btn btn-register auth-nav-btn mt-1"><b>REGISTRATE</b></a>
@endsection

@section('content')

    <div class="col-lg-12 col-md-12 col-sm-12 pt-4 pb-2">   
        <h2 class="text-center">BIENVENIDO DE NUEVO!</h2>
    </div>

    <!-- Usuario -->
    <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
        <label><b>Usuario</b> *</label>
        <input type="text" name="user_alias" class="form-control user-alias" placeholder="Ingresa tu usuario" onkeypress="allowAlphaNumericSpace(event)">
    </div>
    <!-- Contraseña -->
    <div class="col-lg-12 col-md-12 col-sm-12  mt-3">
        <label><b>Contraseña</b> *</label>
        <input type="password" name="user_password" class="form-control user-password" placeholder="Ingresa tu contraseña" onkeypress="allowAlphaNumericSpace(event)">
    </div>

    <!-- Boton crear cuenta -->
    <div class="col-lg-12 col-md-12 col-sm-12">
        <center> <br>   
            <a href="#" class="text-center btn btn-lg btn-login-action"><b>INICIAR SESION</b></a>
        </center>
    </div>

    <!-- Seccion retorno -->
    <div class="col-lg-12 col-md-12 col-sm-12">
        <center><br>   
            <a href="{{ route('view-reset-password') }}" class="text-center ">¿Has olvidado tu contraseña? Accede aqui!</a>
        </center>
    </div>
@endsection

@section('footer') @endsection

@section('js')
//<script>
    
    // validacion del formulario y envio de datos
    $(".btn-login-action").on('click', function(){

        var username = $('.user-alias').val();
        var password = $('.user-password').val();

        if (username != '' && password != '') {

            var data = {
                "_token" : "{{ csrf_token() }}",
                'username' : username,
                'password' : password
            }

            // Peticion ajax 
            $.ajax({

                type: "POST",
                url: "{{ route('login-user') }}",
                data: data,
                dataType: "json",
                encode: true
            }).done(function (data) {
                
                switch (data.code) {
                    case 200:
                        window.location = "{{ route('view-home') }}";
                        
                        break;
                    case 202: 

                        swal({
                            icon: 'error',
                            text: 'Contraseña incorrecta'
                        }).then(function() {
                            $('.user-alias').val('');
                            $('.user-password').val('');
                        });

                        break;
                    case 404:

                        swal({
                            icon: 'error',
                            text: 'Usuario no existente'
                        }).then(function() {
                            $('.user-alias').val('');
                            $('.user-password').val('');
                        });

                        break;
                }
            });

        } else {
            swal({
                icon: 'error',
                title: 'Oops...',
                text: 'Algunos campos se encuentran vacios'
            });
        }
    });

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