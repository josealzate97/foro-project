
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Titulo -->
        <title>Foro</title>
        <link rel="icon" type="image/png" href="{{ url('images/icon.png') }}">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet"> 
        
        <!-- Bootstrap CDN -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome 4.7 -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- Estilos de la app -->
        <link href="{{ url('css/app.css') }}" rel="stylesheet">

        <!-- Jquery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- javascript global de la app -->
        <script src="{{ url('js/app.js') }}"></script>
        <!-- Sweet Alert Js (Alertas del sistema) -->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </head>

    <nav class="navbar navbar-expand-lg  auth-nav">
        <div class="col-lg-4 col-md-4 col-sm-4">
            <a class="navbar-brand" href="#">
                <b>Foro Sena</b>
            </a>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8">
            @yield('nav')
        </div>    
        
    </nav>

    <body class="col-lg-12 col-md-12 col-sm-12">
        <div class="container bg-auth-div">
            <div class="row">
                <!-- LOGO - ESLOGAN -->
                <div class="col-4 auth-esk-div-one">
                    <div class="auth-eslogan-div">   

                        <h3 class="text-center">Foro Sena</h3>

                        <hr class="bg-white">

                        <div class="auth-eslogan-content-div">
                            <i class="fa fa-question-circle-o fa-2x"></i>&nbsp;
                            <b>PREGUNTA</b>
                        </div>

                        <div class="auth-eslogan-content-div">
                            <i class="fa fa-commenting-o fa-2x"></i>&nbsp;
                            <b>RESPONDE</b>
                        </div>

                        <div class="auth-eslogan-content-div">    
                            <i class="fa fa-thumbs-o-up fa-2x"></i>&nbsp;
                            <b>CALIFICA</b>
                        </div>

                    </div>
                </div>
                <!-- FORMULARIO -->
                <div class="col-8 auth-esk-div-two">
                    @yield('content')
                </div>
            </div>
        </div>
    </body>

    <footer>
        <div class="col-12 auth-footer pb-4 pt-4 text-center">
            <b>Armenia - Colombia 2021</b>    
            @yield('footer')
        </div>
    </footer>

    <script type="text/javascript">
        @yield('js')
    </script>
</html>
