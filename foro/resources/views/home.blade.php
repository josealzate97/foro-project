@extends('layouts.master-layout')

@section('nav-home')

@endsection

@section('content')
    <section class="home-content-div col-lg-12 col-md-12 col-sm-12">
        <!-- Info Header Home -->
        <div class="row">  
            @if(session()->has('user'))
                <div class="col-lg-12 col-md-12 col-sm-12 d-inline-flex">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <h5 class="text-left mt-3">
                            BIENVENIDO
                            <b class="text-user-welcome ">{{ Str::upper(session()->get('user.name')) }} {{ Str::upper(session()->get('user.lastname')) }}</b>
                        </h5>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <a class="btn btn-primary btn-lg btn-make-ask float-right mb-4" href="{{ route('post-create-view') }}">
                            <i class="fa fa-star"></i>&nbsp;
                            <b>Formular una pregunta</b>
                        </a>
                    </div>
                </div> <hr>
            @endif
            <!-- Lista de posts -->
            <div class="col-lg-8 col-md-8 col-sm-8 post-list-div mt-3">

                <h5 class="text-center mb-3">
                    <i class="fa fa-star"></i>&nbsp;
                    <b>PREGUNTAS PRINCIPALES </b>
                </h5>

                @foreach ($posts as  $row)

                    <div class="post-list-contenedor ml-1 mr-1" id-post="{{ $row['id'] }}">
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
                                <b>
                                    <a href="{{ route('post-info', [ 'id' => $row['id'] ] ) }}">
                                        {{ $row['title'] }}
                                    </a>
                                </b>
                                
                                <div class="d-inline-flex">
                                    <!-- tags -->
                                    <div class="col-6 mt-2">
                                        <?php
                                            
                                            $tags = (array) $row['tags'];
                                            
                                            foreach ($tags as $key => $value) {
                                                echo "<b class='post-tags'>".$value."</b>";
                                            }
                                        ?>
                                    </div>

                                    <!-- Fecha -->
                                    <div class="col-6  mt-2">
                                        <b class="post-date">{{ $row['username'] }} -  {{ $row['date'] }} </b> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@section('js')
//<script>
    
@endsection