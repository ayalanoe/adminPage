<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin @yield('titulo')</title>
    <link rel="shortcut icon" href="{{ asset('iconoFacultad/logoues.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/f3b9f07ba0.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/cssAdministrador/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styleNav.css') }}">

    <!-- CDN de sweetAlert para las alertas de confirmaciones -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- CDN de JQUERY para poder usar algunas funciones antes de enviar el formulario de la contraseña ---------------------------------------------------------- -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- --------------------------------------------------------------------------------------------------------------------------------------------------------- -->

    <!-- CDN para poder usar lo de darle formato al txto de crar anuncios ----------------------->
        <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
    <!-- ---------------------------------------------------------------------------------------->


    @yield('css') <!-- Esto es para cargar los estilos de las vistas del administrdor ya que los estilos se cargan en el head del html-->

</head>
<body>
    <div class="wrapper">
        <aside id="sidebar">
            <div class="h-100">
                <div class="sidebar-logo">
                    <div class="row">
                        <div class="col-12 col-md-12 d-flex">
                                    <!--posicion de la imagen dentro del contenedor-->
                                        <div class="row">
                                            <div class="col-6 col-md-12 d-flex">
                                                <div class=""> <!--Padding y margin del texto-->
                                                    <img src="{{ asset('images/logoues.png') }}" alt="" class="img-fluid-logo">
                                                </div> 
                                            </div>                                      
                                        </div>
                                        <div class="row">
                                            <div class="col-6 col-md-12 d-flex">
                                                <div class="p-2"> <!--Padding y margin del texto-->
                                                    <a href="{{route('privada')}}">Académica FMO</a>
                                                </div> 
                                            </div>                                              
                                        </div>
                                        
                                    
                        </div>
                    </div>


                </div>
                <ul class="sidebar-nav">

                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#Anuncios" data-bs-toggle="collapse" aria-expanded="false">
                            <i class="fa-solid fa-newspaper pe-2"></i>
                            Anuncios Académicos
                        </a>
                        <ul id="Anuncios" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="{{ route('gestionAnuncios') }}" class="sidebar-link">Registro de Anuncios</a>
                            </li>
                            
                        </ul>
                    </li>

                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#calendarios" data-bs-toggle="collapse" aria-expanded="false">
                            <i class="fa-solid fa-calendar pe-2"></i>
                            Calendario Oficial
                        </a>
                        <ul id="calendarios" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="{{route ('mostrarCalendarioAdmin')}}" class="sidebar-link">Calendario Administrativo</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{route('subirHorarioClases')}}" class="sidebar-link">Calendario Académico</a>
                            </li>f
                        </ul>
                    </li>

                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#constanciasFMO" data-bs-toggle="collapse" aria-expanded="false">
                            <i class="fa-solid fa-folder pe-2"></i>
                            Constancias
                        </a>
                        <ul id="constanciasFMO" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="{{ route('registrosConstancias') }}" class="sidebar-link">Registrar Constancia</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ route('informeConstancias') }}" class="sidebar-link">Generar Informe</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#croquisFMO" data-bs-toggle="collapse" aria-expanded="false">
                            <i class="fa-solid fa-map-location-dot pe-2"></i>
                            Croquis FMO
                        </a>
                        <ul id="croquisFMO" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="{{ route('croquis') }}" class="sidebar-link">Gestionar Croquis</a>
                            </li>
                        </ul>
                    </li>
                    

                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#DirectContact" data-bs-toggle="collapse" aria-expanded="false">
                            <i class="fa-solid fa-address-book pe-2"></i>
                            Directorio de Contactos
                        </a>
                        <ul id="DirectContact" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="{{ route('gestionDirectorio') }}" class="sidebar-link">Ver Directorio</a>
                            </li>
                            
                        </ul>
                    </li>

                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#eduDistancia" data-bs-toggle="collapse" aria-expanded="false">
                            <i class="fa-solid fa-chalkboard-user pe-2"></i>
                            Educación a Distancia
                        </a>
                        <ul id="eduDistancia" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item pe-2">
                                <a href="{{ route('carrerasDistancia') }}" class="sidebar-link">Otras Facultades</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ route('carrerasDistanciaFmo') }}" class="sidebar-link">Facultad Oriente - FMO</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#DirectFacultad" data-bs-toggle="collapse" aria-expanded="false">
                            <i class="fas fa-university pe-2"></i>
                            Facultades
                        </a>
                        <ul id="DirectFacultad" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="{{ route('filtroContactosFacultades') }}" class="sidebar-link">Ver Directorio</a>
                            </li>
                            
                        </ul>
                    </li>

                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#GaleriaAcademica" data-bs-toggle="collapse" aria-expanded="false">
                            <i class="fa-solid fa-image pe-2"></i>
                            Galería Institucional
                        </a>
                        <ul id="GaleriaAcademica" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="{{ route('gestionGaleria') }}" class="sidebar-link">Gestionar Galería</a>
                            </li>
                            
                        </ul>
                    </li>

                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#GesUser" data-bs-toggle="collapse" aria-expanded="false">
                            <i class="fa-solid fa-circle-user pe-2"></i>
                            Gestión de Usuarios
                        </a>
                        <ul id="GesUser" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="{{ route('gestionUsuarios') }}" class="sidebar-link">Ver usuarios</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ route('registro') }}" class="sidebar-link">Crear Usuario</a>
                            </li>
                            
                        </ul>
                    </li>

                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#HorarioAdministrativo" data-bs-toggle="collapse" aria-expanded="false">
                            <i class="fa-solid fa-clock pe-2"></i>
                            Horario de Atención
                        </a>
                        <ul id="HorarioAdministrativo" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="{{ route('gestionHorario') }}" class="sidebar-link">Horario Actual</a>
                            </li>
                            
                        </ul>
                    </li>

                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#nuevoIngreso" data-bs-toggle="collapse" aria-expanded="false">
                            <i class="fa-solid fa-address-card pe-2"></i>
                            Nuevo Ingreso
                        </a>
                        <ul id="nuevoIngreso" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="{{ route('vertiposingreso') }}" class="sidebar-link">Tipos de Ingreso</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ route('ReqFe') }}" class="sidebar-link">Requisitos y Fechas</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ route('aplicarLinea') }}" class="sidebar-link">Aplicar en Línea</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ route('verCatalogo') }}" class="sidebar-link">Catálogo Académico</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#planesEstudio" data-bs-toggle="collapse" aria-expanded="false">
                            <i class="fa-solid fa-graduation-cap pe-2"></i>
                            Planes de Estudio
                        </a>
                        <ul id="planesEstudio" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="{{ route('departamentosPregrado') }}" class="sidebar-link">Carreras de Pregrado</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ route('carrerasPosgrado') }}" class="sidebar-link">Carreras de Posgrado</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ route('verListaDiplomados') }}" class="sidebar-link">Diplomados Impartidos</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ route('carrerasTecnicas') }}" class="sidebar-link">Carreras Técnicas</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#PreguntasFrecuentes" data-bs-toggle="collapse" aria-expanded="false">
                            <i class="fa-solid fa-circle-question pe-2"></i>
                            Preguntas Frecuentes
                        </a>
                        <ul id="PreguntasFrecuentes" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="{{ route('verPreguntasFrecuentes') }}" class="sidebar-link">Listado de Preguntas</a>
                            </li>
                            
                        </ul>
                    </li>

                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#paginas" data-bs-toggle="collapse" aria-expanded="false">
                            <i class="fa-solid fa-list pe-2"></i>
                            Trámites Académicos
                        </a>
                        <ul id="paginas" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="{{ route('verTramitesAcademicos') }}" class="sidebar-link">Gestion de Trámites</a>
                            </li>
                            
                        </ul>
                    </li>
                </ul>
            </div>
        </aside>
        <div class="main">
            <nav class="navbar">
                <button class="btn hola" id="sidebar-toggle">        <!--BOTON DE HERRAMIENTAS DEL SIDEBAR-->
                    <i class="fa-solid fa-bars fonIcon"></i>
                </button>
               
                <div class="navbar navbar-expand-lg bg-body-tertiary menuNav">
                    <div class="container-fluid">
                    
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                        <div class="collapse navbar-collapse" id="navbarNavDropdown">
                            <ul class="navbar-nav">
                                
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-circle-user"></i> @auth {{Auth::user()->name}} @endauth
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item">
                                            <a class="nav-link " href="Datos" data-bs-toggle="modal" data-bs-target="#ModalMisDatos">Mi Perfil</a>
                                            <a class="nav-link " href="EdiciónPass" data-bs-toggle="modal" data-bs-target="#ModalEditarContraseña">Cambiar Contraseña</a>

                                            <a class="nav-link " href="{{ route('logout') }}">Cerrar Sesión</a>                                            
                                        </li>
                                    </ul>
                                </li>
                               
                                
                                
                            
                            </ul>
                        </div>
                        </div>
                    </div>
            </nav>


            
            
            <!-- Modal -->
            <div class="modal fade" id="ModalMisDatos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Mis Datos de Perfil</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            

                            <form id="formActulizarDatos" action="{{route('actulizarDatosUsuario', Auth::user()->id) }}" method="POST" class="row g-3 needs-validation" novalidate>
                                @csrf

                                <div class="col-md-12">
                                <label for="validationCustomUser" class="form-label">Usuario</label>
                                <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-user"></i></span>
                                <input name="Nombre" type="text" class="form-control" id="validaUser" required value="{{Auth::user()->name}}">
                                <div class="valid-feedback">
                                    Usuario Válido!
                                </div>
                                </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <label for="validationCustomCorreo" class="form-label">Correo Electrónico</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-at"></i></span>
                                        <input name="Correo" type="text" class="form-control" id="validaCorreo" aria-describedby="inputGroupPrepend" required value="{{Auth::user()->email}}">
                                        <div class="invalid-feedback">
                                            Please choose a username.
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btnCancelPerfil">Cancelar</button>
                                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal" id="ActualizaPerfil">Actualizar Datos</button>
                                </div>

                            </form>

                        </div>
                        
                    </div>
                </div>
            </div>



            <!-- Modal Cambiar contraseña-->
            <div class="modal fade" id="ModalEditarContraseña" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modificación de Contraseña</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form id="formCambiarPassword" action="{{ route('actulizarPassword', Auth::user()->id) }}" method="POST" class="row g-3 needs-validation" novalidate>
                            @csrf
                            
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <input name="passwordActual" type="password" class="form-control" id="passActual" placeholder="name@example.com">
                                    <label for="floatingInput">Contraseña Actual</label>
                                </div>
                            
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <input name="newPassword" type="password" class="form-control" id="passNueva" placeholder="Password">
                                    <label for="floatingPassword">Nueva Contraseña</label>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input name="confirmarNewPassword" type="password" class="form-control" id="confirmarPassNueva" placeholder="Password">
                                    <label for="floatingPassword">Confirmar Contraseña</label>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btnCancelPerfil">Cancelar</button>
                                <button type="submit" class="btn btn-primary" id="ActualizaPerfil">Actualizar Contraseña</button>
                            </div>

                        </form>
                    </div>
                    
                </div>
                </div>
            </div>

            @yield('modales') <!-- Para los modales de otras vistas -->

            <!-- TARJETA DE LAS SECCIONES DEL CONTENIDO DE LA WEB-->
            <main id="contenidoPrincipal" class="content px-3 py-2">
                <!-- En esta parte se mandaran a llamar las vista induvidules que se hagan, en este caso se usa la notacion 
                    "yield" para poder llamar las vistas idividuales que se hagan. En este caso yield permite buscar una seccion con el nombre específo que
                    definamos, en este caso utilizaremos la palabra "contenido" que hará referencia a todo lo que queremos mostrar en el centro del dasboard cunado se 
                    seleccione una opcion de las que están en el menú
                -->
                @yield('contenido')
                
            </main>

            
            
            <a href="#" class="theme-toggle">
                <i class="fa-solid fa-moon"></i>
                <i class="fa-solid fa-sun"></i>
            </a>
            
        </div>
    </div>

    <!--
    <div class="notificacion">
        <p>Bienvenido a Academica!</p>
        <span class="notificacion_progreso"></span>
    </div>
    -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('AdminJS/tema.js') }}"></script>
    <script src="{{ asset('AdminJS/scriptNav.js') }}"></script>


    <script src="{{ asset('AdminJS/PerfilModal.js') }}"></script>

    
    
    @yield('jsVistasAdmin') <!-- para ingresar los java script de las vistas personalizdas -->

    <!-- Codigo para las respuestas del controlador si completo la acción actulizar los datos del usuario y la contraseña (MODALES) -->
    
        @if (Session::has('successDatosPerfil'))
            <script>
                Swal.fire({
                    title: "Informacion",
                    text: "{{ session('successDatosPerfil') }}",
                    icon: "success"
                });
            </script>
        @endif

        @if (Session::has('errorUsuario')) <!-- Por si el usuario no existe en editrar perfil y password -->
            <script>
                Swal.fire({
                    title: "Informacion",
                    text: "{{ session('errorDatosPerfil') }}",
                    icon: "success"
                });
            </script>
        @endif
        
        <!-- Codigo de validacion y respues para el modal del cambiar password -->
        <script>
            $('#formCambiarPassword').on('submit', function(e){
                
                e.preventDefault(); // Corregir aquí

                // Por ejemplo:
                var passwordActual = $('#passActual').val();
                var newPassword = $('#passNueva').val();
                var confirmarNewPassword = $('#confirmarPassNueva').val();

                if (passwordActual.trim() === '' || newPassword.trim() === '' || confirmarNewPassword.trim() === '') {
                    
                    Swal.fire({
                        title: "Informacion",
                        text: "Campos vacios",
                        icon: "error"
                    });

                    return;
                }

                if (newPassword !== confirmarNewPassword) {
                    
                    Swal.fire({
                        title: "Informacion",
                        text: "Las contraseñas no coinciden",
                        icon: "error"
                    });
                    return;
                }

                Swal.fire({
                    title: "¿Está seguro de actulizar la contreseña?",
                    text: "Se cambiará la contraseña de acceso",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Si, Actualizar"
                }).then((result) => {
                    if (result.isConfirmed) {
                    this.submit()
                    }
                });

            })

            $('#formActulizarDatos').on('submit', function(e){
                e.preventDefault();
                Swal.fire({
                    title: "¿Está seguro?",
                    text: "Se actulizará el usuario y el correo de acceso",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Si, Actualizar"
                }).then((result) => {
                    if (result.isConfirmed) {
                    this.submit()
                    }
                });
            })
        </script>

        <!-- Alertas por parte del servidor, es decir las repuestas del controlador -->
        @if (Session::has('passActulizada'))
            <script>
                Swal.fire({
                    title: "Informacion",
                    text: "{{ session('passActulizada') }}",
                    icon: "success"
                });
            </script>   
        @endif

        @if (Session::has('passError'))
            <script>
                Swal.fire({
                    title: "Informacion",
                    text: "{{ session('passError') }}",
                    icon: "error"
                });
            </script>   
        @endif
        

    <!-- ---------------------------------------------------------------------------------------------------------------------------- -->

</body>
</html>