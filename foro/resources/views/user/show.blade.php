@extends('layouts.master-layout')

@section('nav-home')

@endsection

@section('content')
    {{ csrf_field() }}
    <section class="home-content-div col-lg-12 col-md-12 col-sm-12">
        
        <h5 class="text-center">
            <i class="fa fa-user"></i>&nbsp;
            <b>INFORMACION DE USUARIO</b>
        </h5><hr>

        <div class="col-lg-12 col-md-12 col-sm-12 mt-5 user-info-div">
            <div>
                <i class="fa fa-user"></i>&nbsp;
                <label>Nombre de usuario</label>
                <b class="float-right">{{ $user->username }}</b>
            </div>
            
            <div class="mt-3">
                <i class="fa fa-id-card"></i>&nbsp;
                <label>Nombres</label>
                <b class="float-right">{{ $user->name }}</b>
            </div>

            <div class="mt-3">
                <i class="fa fa-id-card"></i>&nbsp;
                <label>Apellidos</label>
                <b class="float-right">{{ $user->lastname }}</b>
            </div>

            <div class="mt-3">
                <i class="fa fa-envelope"></i>&nbsp;
                <label>Correo Electronico</label>
                <b class="float-right">{{ $user->email }}</b>
            </div>

            <div class="mt-3">
                <i class="fa fa-calendar"></i>&nbsp;
                <label>Fecha de creacion</label>
                <b class="float-right">{{ $user->created_at }}</b>
            </div>
        </div> 
        
        <hr>

        <div class="col-lg-12 col-md-12 col-sm-12 mt-5">
            <center>
                <a href="{{ route('view-home') }}" class="btn btn-login-action">
                    <i class="fa fa-arrow-left"></i>&nbsp;
                    <b>Volver</b>
                </a>
            </center>
        </div>
    </div>
@endsection

@section('js')

@endsection