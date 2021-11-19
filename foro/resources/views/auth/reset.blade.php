@extends('layouts.auth-layout')


@section('nav')
    <a href="{{ route('login') }}" class="text-center btn btn-warning auth-nav-btn mt-3"><b>INICIAR SESION</b></a>
@endsection

@section('content')

    <div class="col-lg-12 col-md-12 col-sm-12 pt-4 pb-3">   
        <h2 class="text-center">¿OLVIDASTE TU CONTRASEÑA?</h2>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12"> 
        <p>
            Lo entendemos, estas cosas pasan. Tranquilo simplemente ingresa tu correo electronico
            y te enviaremos las instrucciones para restablecer tu contraseña
        </p>
    </div>
    <!-- Usuario -->
    <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
        <label><b>Correo Electronico</b> *</label>
        <input type="email" name="user_email" class="form-control user_email" placeholder="Ingresa tu correo electronico">
    </div>

    <!-- Boton crear cuenta -->
    <div class="col-lg-12 col-md-12 col-sm-12">
        <center> <br>   
            <a href="#" class="text-center btn btn-warning btn-lg"><b>RESTABLECER CONTRASEÑA</b></a>
        </center>
    </div>

    <!-- Seccion retorno -->
    <div class="col-lg-12 col-md-12 col-sm-12">
        <center><br><br>   
            <a href="{{ route('login') }}" class="text-center ">
                Iniciar Sesion
            </a>
            - 
            <a href="{{ route('view-register') }}" class="text-center ">
                Crea tu cuenta
            </a>
        </center>
    </div>
@endsection

@section('footer') @endsection