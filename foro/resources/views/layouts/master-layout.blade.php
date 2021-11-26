
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

    <nav class="navbar navbar-expand-lg col-lg-12 col-md-12 col-sm-12 auth-nav">
        <div class="collapse navbar-collapse">
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav col-lg-12 col-md-12 col-sm-12">
                    <div class="col-lg-2 col-md-2 col-sm-2">
                        <a class="navbar-brand" href="#">
                            <img class="auth-nav-img d-inline-block align-top" src="{{ url('images/icon.png') }}" width="30" height="30" alt="">
                        </a>
                    </div>
                    @if(session()->has('user'))
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <a class="nav-item nav-link active" href="#">Inicio <span class="sr-only">(current)</span></a>
                            <a class="nav-item nav-link" href="#">Posts</a>
                            <a class="nav-item nav-link" href="#">Reciente</a>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                        </div>
                    @else
                        <div class="col-lg-10 col-md-10 col-sm-10">
                            <a href="{{ route('view-register') }}" class="text-center btn btn-warning auth-nav-btn"><b>REGISTRATE</b></a>
                            <a href="{{ route('login') }}" class="text-center btn btn-warning auth-nav-btn"><b>INICIAR SESION</b></a>
                        </div>    
                    @endif
                </div>
            </div>
        </div>  
    </nav>

    <body class="col-lg-12 col-md-12 col-sm-12">
        <div class="container bg-auth-div">
            <div class="row">
                @yield('content')
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
