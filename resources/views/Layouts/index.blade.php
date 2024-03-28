<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Académica FMO @yield('titulo-publico')</title>
    <link rel="shortcut icon" href="{{ asset('iconoFacultad/logoues.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/41bcea2ae3.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/principal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styleNav.css') }}">

    @yield('css-publico')

    <!-- CDN de sweetAlert para las alertas de confirmaciones -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- CDN de JQUERY para poder usar algunas funciones antes de enviar el formulario de la contraseña ---------------------------------------------------------- -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- --------------------------------------------------------------------------------------------------------------------------------------------------------- -->

</head>
<body>
    
    <header id="header">
        <div class="container__header">
            <div class="logo">
                <img src="{{ asset('images/logoues.png') }}" alt="logo de la universidad de El Salvador" class="imgLogo">
            </div>
            <div class="container__nav">
                <nav id="nav">
                    <ul>
                        <li><a href="/" class="select">INICIO</a></li>
                        <li><a href="https://eel.ues.edu.sv/ingreso" target="_blank">NUEVO INGRESO</a></li>

                        <li><a class="dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">PLANES DE ESTUDIO</a>
                            <ul class="dropdown-menu planes">
                                <li class="nav-item dropend">
                                    <a class="nav-link" href="{{ route('planes') }}">
                                            CARRERAS DE PREGRADO
                                    </a>        
                                    <a class="nav-link" href="#">
                                        CARRERAS DE POSGRADO
                                    </a>        
                                    <a class="nav-link" href="#">
                                        CARRERAS TÉCNICAS
                                    </a>
                                    <a class="nav-link" href="#">
                                        PLANES COMPLEMENTARIOS
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li><a href="{{ route('directorio') }}">DIRECTORIO</a></li>
                        <li><a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">CALENDARIO OFICIAL</a>
                            <ul class="dropdown-menu calendario">
                                <li class="nav-item dropend">
                                    

                                    <a class="nav-link" href="{{route('publicVerCalAdmin')}}" target="_blank">
                                        ADMINISTRATIVO
                                    </a>
                                    
                                    <a class="nav-link" href="{{ route('publicVerCalAcademico') }}" target="_blank">
                                        ACADÉMICO
                                    </a>        
                                </li>
                            </ul>
                        </li>
                        
                        <li><a href="{{ route('educDistancia') }}">EDUCACIÓN A DISTANCIA</a></li>
                        <li><a href="{{ route('verContactosFacultad') }}">FACULTADES</a></li>
                    </ul>
                </nav>

                
                <div class="btn__menu" id="btn_menu"><i class="fas fa-bars"></i></div>

            </div>

        </div>
    </header>
    
        <div class="cover">

            @yield('contenido-publico')

        </div>

        <Footer>
            <div class="container__footer">

                <div class="box__footer">
                    <h2>Sitios de Interés</h2>
                    <a href="http://www.fmoues.edu.sv/" target="_blank">UES-FMO</a>
                    <a href="https://www.ues.edu.sv/" target="_blank">UES-SITIO PRINCIPAL</a>
                    <a href="https://www.uese.ues.edu.sv/" target="_blank"><i class="fa-solid fa-scale-balanced"></i> UES-SOCIOECONÓMICO</a>
                    <a href="http://proyeccionsocial.fmoues.edu.sv/" target="_blank">UES-PROYECCIÓN SOCIAL</a>
                    <a href="https://saa.ues.edu.sv/" target="_blank">UES-SAA</a>
                </div>

                <div class="box__footer">
                    <h2>Plataformas</h2>
                    <a href="https://virtual.fmoues.edu.sv/" target="_blank"><i class="fa-solid fa-landmark pe-2"></i>Aula Virtual UES</a>
                    <a href="https://eel.ues.edu.sv/session/index" target="_blank">
                        <i class="fa-solid fa-file pe-3"></i>Expediente en Línea</a>

                    <div class="dropdown mt-3">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#paginas" data-bs-toggle="collapse" aria-expanded="false">
                            <i class="fa-solid fa-list pe-2"></i>
                            Expediente Móvil
                        </a>
                        <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="https://play.google.com/store/apps/details?id=meel.ganimedes" target="_blank">Google Play</a></li>
                        <li><a class="dropdown-item" href="https://appgallery.huawei.com/#/app/C102387785" target="_blank">App Galery</a></li>
                        </ul>
                    </div>
                </div>

                <div class="box__footer">
                    <h2>Medios de contacto</h2>
                    <a href="https://www.facebook.com/oficial.fmo" target="_blank"><i class="fab fa-facebook-square"></i> Facebook</a>
                    <a href="#"><i class="fa-solid fa-envelope"></i> academica.fmoues@ues.edu.sv</a>
                    <a href="#"><i class="fa-solid fa-phone"></i> 2664 - 0000</a>
                    <a href="https://maps.app.goo.gl/v5TpzoRMaBS7LXwA9" target="_blank" class="ubicado"><i class="fa-solid fa-location-dot"></i> Km. 144 Carretera al Cuco, Cantón El Jute, San Miguel. El Salvador, Centro América.</a>
                </div>
            </div>

            <div class="box__copyright">
                <hr>
                <p>Todos los derechos reservados © 2024 <b>| Académica FMO</b></p>
            </div>
        </Footer>
    



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/principalWave.js"></script>

    @if (Session::has('errorPublicCalAdmin'))
        <script>
            Swal.fire({
                title: "Informacion",
                text: "{{ session('errorPublicCalAdmin') }}",
                icon: "error"
            });
        </script>   
    @endif

    @if (Session::has('errorPublicCalAcademico'))
        <script>
            Swal.fire({
                title: "Informacion",
                text: "{{ session('errorPublicCalAcademico') }}",
                icon: "error"
            });
        </script>   
    @endif

</body>
</html>