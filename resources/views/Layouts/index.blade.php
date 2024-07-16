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
    <link rel="stylesheet" href="{{ asset('css/cover.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styleNav.css') }}">

    
    @yield('css-publico')

    <!-- CDN de sweetAlert para las alertas de confirmaciones -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- CDN de JQUERY para poder usar algunas funciones antes de enviar el formulario de la contraseña ---------------------------------------------------------- -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- --------------------------------------------------------------------------------------------------------------------------------------------------------- -->

</head>
<body>
    
    <nav class="navbar navbar-expand-lg navstyle" id="header">
        <div class="container-fluid">

            <div class="logo">
                <a href="/">
                    <img src="{{ asset('images/logoues.png') }}" alt="logo de la universidad de El Salvador" class="imgLogo">
                </a>
            </div>

            <button class="navbar-toggler btnNav" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <!--<button class="navbar-toggler btnNav" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">-->
                <!--<span class="navbar-toggler-icon "></span>-->
                <i class="fa-solid fa-bars iconMenu"></i>
            </button>

            <div class="collapse navbar-collapse container__nav" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="/" class="select active">INICIO</a>
                        <!-- <a href="/" class="select nav-link active">INICIO</a>--->
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            NUEVO INGRESO
                        </a>
                        <ul class="dropdown-menu ingreso">
                            <li><a class="dropdown-item" href="{{ route('tiposIngresos') }}">TIPOS DE INGRESO</a></li>
                            <li><a class="dropdown-item" href="{{ route('requisitosFechas') }}">REQUISITOS Y FECHAS</a></li>
                            <li><a class="dropdown-item" href="{{ route('enLinea') }}">APLICAR EN LÍNEA</a></li>
                            <li><a class="dropdown-item" href="{{ route('oferta') }}">OFERTA ACADÉMICA</a></li>
                            <li><a class="dropdown-item" href="{{ route('catalogoAcademico') }}">CATÁLOGO ACADÉMICO</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            PLANES DE ESTUDIO
                        </a>
                        <ul class="dropdown-menu planes">
                            <li><a class="dropdown-item" href="{{ route('planesPre') }}">CARRERAS DE PREGRADO</a></li>
                            <li><a class="dropdown-item" href="{{ route('planesPos') }}">CARRERAS DE POSGRADO</a></li>
                            <li><a class="dropdown-item" href="{{ route('diplomados') }}">DIPLOMADOS</a></li>
                            <li><a class="dropdown-item" href="{{ route('tecnicos') }}">CARRERAS TÉCNICAS</a></li>
                            <li><a class="dropdown-item" href="{{ route('complementarios') }}">PLANES COMPLEMENTARIOS</a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('directorio') }}">DIRECTORIO</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            CALENDARIO OFICIAL
                        </a>
                        <ul class="dropdown-menu calendario">
                            <li><a class="dropdown-item" href="{{ route('publicVerCalAdmin') }}">ADMINISTRATIVO</a></li>
                            <li><a class="dropdown-item" href="{{ route('publicVerCalAcademico') }}">ACADÉMICO</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            EDUCACIÓN A DISTANCIA
                        </a>
                        <ul class="dropdown-menu eduDistancia">
                            <li><a class="dropdown-item" href="{{ route('distanciaFMO') }}">FMO</a></li>
                            <li><a class="dropdown-item" href="{{ route('educDistancia') }}">OTRAS FACULTADES</a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('verContactosFacultad') }}">FACULTADES</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
    
        <div class="cover">
            @yield('contenido-publico')
        </div>
        <i class="fa-solid fa-chevron-down fa-3x"></i>
        <Footer>
            <div class="container__footer">

                <div class="box__footer">
                    <h2 class="sitios">Sitios de Interés</h2>
                    <a href="http://www.fmoues.edu.sv/" target="_blank">UES-FMO</a>
                    <a href="https://www.ues.edu.sv/" target="_blank">UES-SITIO PRINCIPAL</a>
                    <a href="https://www.uese.ues.edu.sv/" target="_blank">UES-SOCIOECONÓMICO</a>
                    <a href="http://proyeccionsocial.fmoues.edu.sv/" target="_blank">UES-PROYECCIÓN SOCIAL</a>
                    <a href="https://saa.ues.edu.sv/" target="_blank">UES-SAA</a>
                </div>

                <div class="box__footer">
                    <h2 class="plataformas">Plataformas</h2>
                    <a href="https://virtual.fmoues.edu.sv/" target="_blank">
                        <i class="fa-solid fa-landmark pe-2"></i>Aula Virtual UES</a>
                    <a href="https://eel.ues.edu.sv/session/index" target="_blank">
                        <i class="fa-solid fa-file pe-3"></i>Expediente en Línea</a>


                    <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-list pe-2"></i>Expediente Móvil</a>
                        <ul class="dropdown-menu expediente">
                            <li class="nav-item dropend">
                                <a class="nav-link" href="https://appgallery.huawei.com/#/app/C102387785" target="_blank">App Galery</a>
                                <a class="nav-link" href="https://play.google.com/store/apps/details?id=meel.ganimedes" target="_blank">Google Play</a>  
                            </li>
                        </ul>
                    

                </div>

                <div class="box__footer">
                    <h2 class="medios">Medios de contacto</h2>
                    <a href="#"><i class="fa-solid fa-envelope"></i> academica.fmoues@ues.edu.sv</a>
                    <a href="#"><i class="fa-solid fa-phone"></i> 2664 - 0000</a>
                    <a href="https://maps.app.goo.gl/v5TpzoRMaBS7LXwA9" target="_blank" class="ubicado">
                        <i class="fa-solid fa-location-dot"></i> Km. 144 Carretera al Cuco, Cantón El Jute, San Miguel. El Salvador, Centro América.</a>
                </div>
            </div>

            <div class="box__copyright">
                <hr>
                <p>Developed By Social Service D&N | Todos los derechos reservados © {{date('Y')}} <b>| Académica FMO</b></p>
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

    @if (Session::has('resErrorCrquis'))
        <script>
            Swal.fire({
                title: "Informacion",
                text: "{{ session('resErrorCrquis') }}",
                icon: "error"
            });
        </script>   
    @endif

</body>
</html>