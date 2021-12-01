
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Titulo -->
        <title>Foro</title>
        <link rel="icon" type="image/png" href="{{ url('images/icon.png') }}">

        <!-- Fonts -->
        <link href='https://fonts.googleapis.com/css?family=Permanent Marker' rel='stylesheet'>
        
        <!-- Bootstrap CDN -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome 4.7 -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- Estilos de la app -->
        <link href="{{ url('css/app.css') }}" rel="stylesheet">
        <!-- Simple tags -->
        <link href="{{ url('css/amsify.suggestags.css') }}" rel="stylesheet">

        <!-- Jquery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- javascript global de la app -->
        <script src="{{ url('js/app.js') }}"></script>
        <!-- Sweet Alert Js (Alertas del sistema) -->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"  crossorigin="anonymous"></script>
        <!-- Simple tags -->
        <script src="{{ url('js/jquery.amsify.suggestags.js') }}"></script>

    </head>

    <nav class="navbar navbar-expand-lg auth-nav">
        @if(session()->has('user'))
            <div class="col-lg-3 col-md-3 col-sm-3">    
                <a class="navbar-brand" href="{{ route('view-home') }}">
                    <b>Vago Programador</b>
                </a>
            </div>

            <div class="collapse navbar-collapse col-lg-9 col-md-9 col-sm-9" id="navbarNavDropdown">        
                <ul class="navbar-nav col-lg-12 col-md-12 col-sm-12">
                    <div class="col-lg-10 col-md-10 col-sm-10 d-inline-flex">
                        
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('view-home') }}">
                                <i class="fa fa-home"></i>
                                Inicio
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fa fa-question"></i>
                                Mis Preguntas
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fa fa-user"></i>
                                Nosotros
                            </a>
                        </li>
                    </div>
                    <div class="dropdown col-lg-2 col-md-2 col-sm-2">
                        <button class="btn-user-session dropdown-toggle mt-3" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-circle online"></i>&nbsp;
                            <b>{{ Str::upper(session()->get('user.username')) }}</b>
                        </button>

                        <ul class="dropdown-menu user-actions" aria-labelledby="dropdownMenuButton2">
                            <li>
                                <a class="dropdown-item" href="{{ route('user-info-view', [session()->get('user.id')] ) }}">
                                    <i class="fa fa-user"></i>&nbsp;<b>Mi Perfil</b>
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}">
                                    <i class="fa fa-sign-out"></i>&nbsp;<b>Cerrar Sesion</b>
                                </a>
                            </li>
                        </ul>
                    </div>
                </ul>
            </div>    
        @else
            <div class="col-lg-4 col-md-4 col-sm-4">
                <a class="navbar-brand" href="#">
                    <b>Vago Programador</b>
                </a>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8">
                <a href="{{ route('view-register') }}" class="text-center btn btn-register auth-nav-btn"><b>REGISTRATE</b></a>
                <a href="{{ route('login') }}" class="text-center btn btn-login auth-nav-btn"><b>INICIAR SESION</b></a>
            </div>        
        @endif  
    </nav>

    <body class="col-lg-12 col-md-12 col-sm-12">
        <div class="container-fluid bg-auth-div">
            @yield('content')
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
