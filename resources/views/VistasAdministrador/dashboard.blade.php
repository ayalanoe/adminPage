<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACADÉMICA FMO</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/f3b9f07ba0.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/cssAdministrador/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styleNav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bienvenida.css') }}">
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
                                                    <a href="#">Académica FMO</a>
                                                </div> 
                                            </div>                                              
                                        </div>
                                        
                                    
                        </div>

                    </div>


















                </div>
                <ul class="sidebar-nav">
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#paginas" data-bs-toggle="collapse" aria-expanded="false">
                            <i class="fa-solid fa-list pe-2"></i>
                            Gestión de Usuarios
                        </a>
                        <ul id="paginas" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">Equivalencias</a>
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
                                <a href="#" class="sidebar-link">Equivalencias</a>
                            </li>
                            
                        </ul>
                    </li>


                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#paginas" data-bs-toggle="collapse" aria-expanded="false">
                            <i class="fa-solid fa-list pe-2"></i>
                            Planes de Estudio
                        </a>
                        <ul id="paginas" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">Equivalencias</a>
                            </li>
                            
                        </ul>
                    </li>



                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#paginas" data-bs-toggle="collapse" aria-expanded="false">
                            <i class="fa-solid fa-list pe-2"></i>
                            Calendrio Oficial
                        </a>
                        <ul id="paginas" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">Equivalencias</a>
                            </li>
                            
                        </ul>
                    </li>


                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#paginas" data-bs-toggle="collapse" aria-expanded="false">
                            <i class="fa-solid fa-list pe-2"></i>
                            Anuncios Académicos
                        </a>
                        <ul id="paginas" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">Equivalencias</a>
                            </li>
                            
                        </ul>
                    </li>

                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#paginas" data-bs-toggle="collapse" aria-expanded="false">
                            <i class="fa-solid fa-list pe-2"></i>
                            Directorio de Contactos
                        </a>
                        <ul id="paginas" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">Equivalencias</a>
                            </li>
                            
                        </ul>
                    </li>
                   
                </ul>
            </div>
        </aside>
        <div class="main">
            <nav class="navbar">
                <button class="btn" id="sidebar-toggle">        <!--BOTON DE HERRAMIENTAS DEL SIDEBAR-->
                    <span class="navbar-toggler-icon"></span>
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
                                        <i class="fa-solid fa-user"></i> Nombre
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item">
                                            <a class="nav-link " href="#">Mi Perfil</a>
                                            <a class="nav-link " href="#">Cerrar Sesión</a>                                            
                                        </li>
                                    </ul>
                                </li>
                               
                                
                                
                            
                            </ul>
                        </div>
                        </div>
                    </div>
            </nav>

            

            <!-- TARJETA DE LAS SECCIONES DEL CONTENIDO DE LA WEB-->
            <main class="content px-3 py-2">
                <div class="container-fluid">
                    
                    <!-- contenedor de tarjetas de plataformas-->
                        
                        
                </div> <!--container fluid-->
            </main>
            <a href="#" class="theme-toggle">
                <i class="fa-solid fa-moon"></i>
                <i class="fa-solid fa-sun"></i>
            </a>
            
        </div>
    </div>

    <div class="notificacion">
        <p>Bienvenido a Academica!</p>
        <span class="notificacion_progreso"></span>
      </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('AdminJS/tema.js') }}"></script>
    <script src="{{ asset('AdminJS/scriptNav.js') }}"></script>
</body>
</html>