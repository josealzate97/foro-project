@extends('layouts.master-layout')

@section('nav-home')

@endsection

@section('content')
    <section class="home-content-div col-lg-12 col-md-12 col-sm-12">
        <!-- Info Header Home -->
        <div class="row">  
            <div class="col-lg-3 col-md-3 col-sm-3">
                <h5>
                    BIENVENIDO
                    <b class="text-user-welcome ">{{ Str::upper(session()->get('user.name')) }} {{ Str::upper(session()->get('user.lastname')) }}</b>
                </h5>
                <hr>

                <center>
                    <a class="btn btn-primary btn-lg btn-make-ask" href="{{ route('post-create-view') }}">
                        <i class="fa fa-star"></i>&nbsp;
                        <b>Formular una pregunta</b>
                    </a>
                </center>
            </div>
            <!-- Lista de posts -->
            <div class="col-lg-5 col-md-5 col-sm-5 post-list-div">

                <h5 class="text-center">PREGUNTAS PRINCIPALES</h5><hr>
                
                <div class="post-list-contenedor ml-1 mr-1">
                    <!-- POSTS -->
                    <div class="post-list col-lg-12 col-md-12 col-sm-12 mb-2 d-inline-flex">
                        <!-- Votos -->    
                        <div class="col-lg-2 col-md-2 col-sm-2 post-votos">
                            <b>0</b>
                            <i class="fa fa-thumbs-up"></i>
                        </div>
                        <!--Comentarios -->
                        <div class="col-lg-2 col-md-2 col-sm-2 post-respuestas">
                            <b>2</b>
                            <i class="fa fa-comment"></i>
                        </div>
                        <!-- Cuerpo Post -->
                        <div class="col-lg-8 col-md-8 col-sm-8 post-body">
                            <b><a href="">Formatear listas</a></b>
                            
                            <div class="d-inline-flex">
                                <!-- tags -->
                                <div class="col-6 mt-2">
                                    <b class="post-tags">php</b>
                                    <b class="post-tags">mysql</b>
                                    <b class="post-tags">Poo</b>
                                </div>

                                <!-- Fecha -->
                                <div class="col-6  mt-2">
                                    <b class="post-date">{{ session()->get('user.username') }} -  Hoy 10:30 am </b> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-lg-4 col-md-4 col-sm-4">

                <h5 class="text-center">PREGUNTAS POPULARES</h5><hr>

                <div class="post-list ml-1 mb-2 mr-1">
                    Oelo
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')

@endsection