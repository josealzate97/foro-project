@extends('layouts.master-layout')

@section('nav-home')

@endsection

@section('content')
    {{ csrf_field() }}
    <section class="home-content-div col-lg-12 col-md-12 col-sm-12 post-detail-div">
        <!-- Detalles del post -->
        <div class="post-detail">
            <!-- Titulo -->
            <h3><b>{{ Str::upper($postData->title) }}</b></h3>
            <!-- info temporal de la pregunta -->
            <p class="mt-1">Formulada por <b>{{ $userPostRelated->username }}</b> el {{ $postData->created_at }}</p> <hr class="bg-dark">
            <!-- Cuerpo -->
            <p class="body mt-2">
                {{ $postData->body }}
            </p>
            <!-- Tags -->
            <b>Tags:</b>&nbsp;&nbsp;
            <?php 
                
                $tags = strpos($postData->tag, ',') == true ? explode(',', $postData->tag) : $postData->tag;
                $tags = (array) $tags;

                foreach ($tags as $key => $value) {
                    echo "<b class='post-tags'>".$value."</b>";
                }
            ?>
        </div>

        <!-- Comentarios -->
        <div class="post-comments col-lg-12 col-md-12 col-sm-12">

            <h6><b>COMENTARIOS</b></h6>
            <hr class="bg-dark">

            <!-- Comentarios ya hechos -->
            @if ($commentArray)

            @foreach($commentArray as $comm)
                <div class="comments-already-done">
                    <div class="col-3 d-inline-flex mb-5">
                        <i class="fa fa-user-circle fa-3x"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                        <div>
                            <p class="text-center mt-2"><b>{{ $comm['user']['username'] }}</b></p>
                        </div>
                    </div>
                    <div class="col-9">
                        
                        <p>{{ $comm['body'] }}</p><br>

                        <p><b>Respondio el {{ $comm['date'] }}</b></p>
                        
                    </div>
                </div>
            @endforeach
  
            @else
                <h4 class="text-center">NO HAY COMENTARIOS AUN</h4>    
            @endif

            <!-- Caja para comentar -->
            <div class="comment-box">
                <label><b>Comentario</b></label>
                <textarea class="form-control mt-2 comment"></textarea>
                <a href="#" class="btn btn-login-action mt-2 save-comment" post-id="{{ $postData->id }}"><b>Enviar Comentario</b></a>
            </div>
        </div>

    </div>
@endsection


@section('js')
//<script>
    // Script al cargar el documento
    $( document ).ready(function() {
        
    });

    $(".save-comment").on('click', function(){
        
        var comment = $(".comment").val();

        if (comment != '') {
            var postId = $(this).attr('post-id');

            var data = {
                "_token" : "{{ csrf_token() }}", 
                "post-id" : postId,
                "comment" : comment
            }

            $.ajax({
                type: "POST",
                url: "{{ route('comment-create') }}",
                data: data,
                dataType: "json",
                encode: true,
            }).done(function (data) {
                if (data) {
                    switch (data.code) {
                        case 200:
                            swal({
                                icon: 'success',
                                text: 'Comentario registrado correctamente'
                            }).then(function() {
                                location.reload();
                            });
                            break;
                        case 404:
                            swal({
                                icon: 'error',
                                text: 'Se ha presentado un error al añadir comentario'
                            });
                            break;    
                    }
                }
            });

        } else {
            swal({
                icon: 'error',
                text: 'El comentario no puede ir vacio, por favor diligenciar nuevamente'
            });
        }
    });
@endsection