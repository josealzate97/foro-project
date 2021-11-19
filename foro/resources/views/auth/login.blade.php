@extends('layouts.auth-layout')


@section('nav')
    <a href="{{ route('view-register') }}" class="text-center btn btn-warning auth-nav-btn mt-3"><b>REGISTRATE</b></a>
@endsection

@section('content')

    <div class="col-lg-12 col-md-12 col-sm-12 pt-4 pb-2">   
        <h2 class="text-center">BIENVENIDO DE NUEVO!</h2>
    </div>

    <!-- Usuario -->
    <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
        <label><b>Usuario</b> *</label>
        <input type="text" name="user_alias" class="form-control user_alias" placeholder="Ingresa tu usuario">
    </div>
    <!-- Contraseña -->
    <div class="col-lg-12 col-md-12 col-sm-12  mt-3">
        <label><b>Contraseña</b> *</label>
        <input type="password" name="user_password" class="form-control user_password" placeholder="Ingresa tu contraseña">
    </div>

    <!-- Boton crear cuenta -->
    <div class="col-lg-12 col-md-12 col-sm-12">
        <center> <br>   
            <a href="#" class="text-center btn btn-warning btn-lg btn-login-action"><b>INICIAR SESION</b></a>
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

    // validacion del formulario
    $(".btn-login-action").on('click', function(){
        
    });

@endsection