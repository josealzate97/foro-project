
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
        <!-- Bootstrap CDN -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Estilos de la app -->
        <link href="{{ url('css/app.css') }}" rel="stylesheet">
        <!-- Jquery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- javascript global de la app -->
        <script src="{{ url('js/app.js') }}"></script>
        <!-- Sweet Alert Js (Alertas del sistema) -->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </head>

    <nav class="col-lg-12 col-md-12 col-sm-12 auth-nav">
        <div class="col-lg-4 col-md-4 col-sm-4">
            <img class="auth-nav-img pt-2 pb-1" src="{{ url('images/icon.png') }}">
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
                        <h3 class="text-center">FORO DEL SENA</h3>
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
