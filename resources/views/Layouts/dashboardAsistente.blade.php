<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asistente @yield('titulo')</title>
    <link rel="shortcut icon" href="{{ asset('iconoFacultad/logoues.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/f3b9f07ba0.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/cssAdministrador/dashboard.css') }}">
   
    <link rel="stylesheet" href="{{ asset('css/cssAdministrador/textoGestionGlobal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cssAdministrador/tablas.css') }}">

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
                            <div class="row">
                                <div class="col-12 col-md-12 d-flex">
                                    <div class="p-1"> <!--Padding y margin del texto-->
                                        <a href="{{route('vistaPrincipalAsistente')}}" class="academic-text">Académica FMO</a>
                                    </div> 
                                </div>                                              
                            </div>
                        </div>
                    </div>


                </div>
                <ul class="sidebar-nav">

                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#constanciasFMO" data-bs-toggle="collapse" aria-expanded="false">
                            <i class="fa-solid fa-folder pe-2"></i>
                            Constancias
                        </a>
                        <ul id="constanciasFMO" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="{{ route('registrosConstanciasAsis') }}" class="sidebar-link sub-options">> Registrar Constancia</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ route('informeConstanciasAsis') }}" class="sidebar-link sub-options">> Generar Informe</a>
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
                                    <ul class="dropdown-menu user-options">
                                        <li class="nav-item">
                                            <a class="nav-link myuser-link" href="Datos" data-bs-toggle="modal" data-bs-target="#ModalMisDatos">Mi Perfil</a>
                                            <a class="nav-link myuser-link" href="EdiciónPass" data-bs-toggle="modal" data-bs-target="#ModalEditarContraseña">Cambiar Contraseña</a>

                                            <a class="nav-link myuser-link" href="{{ route('logout') }}">Cerrar Sesión</a>                                            
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
                            

                            <form id="formActulizarDatos" action="{{route('actulizarDatosUsuarioAsis', Auth::user()->id) }}" method="POST" class="row g-3 needs-validation" novalidate>
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

                        <form id="formCambiarPassword" action="{{ route('actulizarPasswordAsis', Auth::user()->id) }}" method="POST" class="row g-3 needs-validation" novalidate>
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

                // Si la validación es exitosa, puedes permitir que el formulario se envíe
                this.submit();

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