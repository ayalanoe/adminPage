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
    <script src="https://kit.fontawesome.com/f3b9f07ba0.js" crossorigin="anonymous"></script>
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
    
    <nav class="navbar navbar-expand-xl bg-body-tertiary fixed-top bg-custom-color">
        <div class="container">

            <div class="logo me-4">
                <a href="/">
                    <img src="{{ asset('images/logoues.png') }}" alt="logo de la universidad de El Salvador" class="imgLogo">
                </a>
            </div>


            <button class="navbar-toggler contenedor-hamburg" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon hamburg"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav w-100 justify-content-between">
                    <li class="nav-item">
                        <a href="/" class="select nav-link active" id="inicioLink">INICIO</a>
                    </li>                  

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            NUEVO INGRESO
                        </a>
                        <ul class="dropdown-menu">
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
                        <ul class="dropdown-menu">
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
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" target="_blank" href="{{ route('publicVerCalAdmin') }}">ADMINISTRATIVO</a></li>
                            <li><a class="dropdown-item" target="_blank" href="{{ route('publicVerCalAcademico') }}">ACADÉMICO</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            EDUCACIÓN A DISTANCIA
                        </a>
                        <ul class="dropdown-menu">
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

        <footer class="py-4">

            <div class="container footer-margen">

                <!-- BOTONES FLOTANTES ////////////////////////////////////////////--->
                <div class="mb-4">
                    <h2>Otros enlaces</h2>
                    <div class="d-flex justify-content-start">
                        <div class="me-2">
                            
                        </div>

                        <div class="me-2">
                            <a href="{{ route('preguntas') }}" class="btn btn-light">
                                <i class="fa-solid fa-circle-question iconos-footer"></i>
                            </a>
                        </div>

                        <div class="me-2">
                            <a href="{{route('verPdfCroquis')}}" target="_blank" class="btn btn-light">
                                <i class="fa-solid fa-map-location-dot iconos-footer"></i>
                            </a>
                        </div>

                        <div>
                            <a href="https://www.facebook.com/fmoues.oficial" target="_blank" class="btn btn-light">
                                <i class="fa-brands fa-facebook iconos-footer"></i>
                            </a>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-12 col-sm-6 col-lg-4 mb-4 mb-lg-0 titulos-footer">
                        <h2>Sitios de Interés</h2>
                        <a href="http://www.fmoues.edu.sv/" target="_blank">UES-FMO</a><br>
                        <a href="https://www.ues.edu.sv/" target="_blank">UES-SITIO PRINCIPAL</a><br>
                        <a href="https://www.uese.ues.edu.sv/" target="_blank">UES-SOCIOECONÓMICO</a><br>
                        <a href="http://proyeccionsocial.fmoues.edu.sv/" target="_blank">UES-PROYECCIÓN SOCIAL</a><br>
                        <a href="https://saa.ues.edu.sv/" target="_blank">UES-SAA</a>
                    </div>
        
                    <div class="col-12 col-sm-6 col-lg-4 mb-4 mb-lg-0 titulos-footer">
                        <h2>Plataformas</h2>
                        <a href="https://virtual.fmoues.edu.sv/" target="_blank">
                            <i class="fa-solid fa-landmark pe-2"></i>Aula Virtual UES</a><br>
                        <a href="https://eel.ues.edu.sv/session/index" target="_blank">
                            <i class="fa-solid fa-file pe-2"></i>Expediente en Línea</a><br>


                        
                        <div class="dropdown">
                            <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-list pe-2"></i>Expediente Móvil
                            </a>
                            <ul class="dropdown-menu expediente">
                                <li><a class="dropdown-item" href="https://appgallery.huawei.com/#/app/C102387785" target="_blank">App Galery</a></li>
                                <li><a class="dropdown-item" href="https://play.google.com/store/apps/details?id=meel.ganimedes" target="_blank">Google Play</a></li>
                            </ul>
                        </div>
                    </div>
        
                    <div class="col-12 col-sm-6 col-lg-4 titulos-footer">
                        <h2>Medios de contacto</h2>
                        <a href="#"><i class="fa-solid fa-envelope"></i> academica.fmoues@ues.edu.sv</a><br>
                        <a href="#"><i class="fa-solid fa-phone"></i> (+503) 2668-9233</a><br>
                        <a href="https://maps.app.goo.gl/v5TpzoRMaBS7LXwA9" target="_blank" class="ubicado">
                            <i class="fa-solid fa-location-dot"></i> Km. 144 Carretera al Cuco, Cantón El Jute, San Miguel. El Salvador, Centro América.</a>
                    </div>
                </div>
        
                <div class="text-center creditos">
                    <hr>
                    <br>
                    <p>© {{date('Y')}} Académica FMO <b> Todos los derechos reservados</b></p>
                </div>
            </div>
        </footer>
        
    



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