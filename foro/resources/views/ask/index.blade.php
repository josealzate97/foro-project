@extends('layouts.master-layout')

@section('nav-home')

@endsection

@section('content')
    {{ csrf_field() }}
    <section class="home-content-div col-lg-12 col-md-12 col-sm-12 d-inline-flex create-post-parent-div">
        <!-- Create Post -->
        <div class="col-lg-8 col-md-8 col-sm-8 create-post-div mt-2">
            <h5 class="text-center">FORMULANDO UNA PREGUNTA</h5> <hr>
            <!-- Titulo -->
            <div class="col-lg-10 col-md-10 col-sm-10  mb-2">
                <b>Titulo</b><br>
                <p>Sé específico e imagina que estás haciendo la pregunta a otra persona</p>
                <input type="text" class="form-control post-title" placeholder="¿Cual es tu pregunta sobre programacion?, Sé especifico">
            </div>
            <!--Cuerpo -->
            <div class="col-lg-10 col-md-10 col-sm-10 mt-2 mb-2">
                <b>Cuerpo</b><br>
                <p>Incluye toda la información que alguien necesitaría para responder tu pregunta</p>
                <textarea name="textarea" class="form-control post-body" rows="6" cols="50"></textarea>
            </div>

            <!--Etiquetas -->
            <div class="col-lg-10 col-md-10 col-sm-10 mt-2 mb-2">
                <b>Etiquetas</b><br>
                <p>Añade hasta 3 etiquetas para describir sobre qué trata tu pregunta</p>
                <input type="text" class="form-control post-tag simple-tag" placeholder="Ej. php, sql, poo">
            </div>

            <!-- Boton formulario -->
            <div class="col-lg-10 col-md-10 col-sm-10 mt-5">
                <a class="text-center btn btn-create-post btn-lg"><b>Enviar Pregunta</b></a>
            </div>
        </div>
        <!-- Tips -->
        <div class="col-lg-4 col-md-4 col-sm-4 create-post-tips mt-2">
            <h5 class="text-center">REDACTA TU PREGUNTA</h5> <hr>
            
            <p>¡Estás preparado para formular tu primera pregunta relacionada con la programación y la comunidad está aquí para ayudar! Para que obtengas las mejores respuestas, te proporcionamos alguna orientación:</p>
            <br>

            <p>Antes de publicar, haz una búsqueda para averiguar si tu pregunta ya ha sido respondida.</p> <br>

            <ol>
                <li><b>Resume el problema</b></li>
                <li><b>Describe lo que has intentado</b></li>
                <li><b>Cuando sea apropiado, muestra el codigo</b></li>
            </ol>

        </div>
    </div>
@endsection


@section('js')
//<script>
    // Script al cargar el documento
    $( document ).ready(function() {
        $('.simple-tag').amsifySuggestags({
            type :'bootstrap'
        });
    });

    $('.btn-create-post').on('click', function() {
        // textos
        var title = $('.post-title').val();
        var body = $('.post-body').val();
        var tags = $('.post-tag').val();
        
        if (title == '' || body == '' || tags == '') {

            swal({
                icon: 'error',
                text: 'Algunos campos del post estan vacios, por favor diligenciar correctamente'
            });

        } else {
            
            var data = {
                "_token" : "{{ csrf_token() }}",
                "title" : title,
                "body" : body,
                "tags" : tags,
                'userId': "{{session()->get('user.id')}}"
            }
            
            $.ajax({
                type: "POST",
                url: "{{ route('create-post') }}",
                data: data,
                dataType: "json",
                encode: true
            }).done(function (data) {
                if (data) {
                    
                    switch (data.code) {
                        case 200:
                            swal({
                                icon: 'success',
                                text: 'Post creado correctamente'
                            }).then(function() {
                                window.location = "{{ route('view-home') }}";
                            });
                            break;
                        case 404:
                            swal({
                                icon: 'error',
                                text: 'Se ha presentado un error al crear el post'
                            });
                            break;    
                    }
                }
            });

        }
    });

@endsection