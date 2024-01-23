<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>academicafmo - MagtimusPro</title>

    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/41bcea2ae3.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/principal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styleNav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bienvenida.css') }}">
</head>
<body>

    
    <header id="header">
        <div class="container__header">
            <div class="logo">
                <img src="images/logoues.png" alt="" class="imgLogo">
            </div>
            <div class="container__nav">
                <nav id="nav">
                    <ul>
                        <li><a href="#" class="select">INICIO</a></li>
                        <li><a href="#">NUEVO INGRESO</a></li>
                        <li><a href="#">PLANES DE ESTUDIO</a></li>
                        <li><a href="#">CALENDARIO OFICIAL</a></li>
                        <li><a href="#">DIRECTORIO</a></li>
                        <li><a href="#">EDUCACIÓN A DISTANCIA</a></li>
                    </ul>
                </nav>

                
                <div class="btn__menu" id="btn_menu"><i class="fas fa-bars"></i></div>

            </div>

        </div>
    </header>

    <div class="container__all" id="container_all">

        <div class="cover">

            <div class="container__cover">

                <div class="container__info">
                    <h1>ADMINISTRACIÓN</h1>
                    <h2>ACADÉMICA FMO</h2>
                    <p>Bienvenidos al sitio web oficial de la administración académica de la Facultad Multidisciplinario Oriental
                        de la Universidad de El Salvador. Encontrarás información relacionada a trámites académicos de tu interés, así como anuncios,
                        entre otros asuntos importantes.</p>
                    







                        <a class="btn btn-primary btn-tramites" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                            Ver información
                          </a>
                          
                          <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                            <div class="offcanvas-header">
                              <h5 class="offcanvas-title" id="offcanvasExampleLabel">Trámites Académicos</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                              
                              <div class="dropdown mt-3">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                  Dropdown button
                                </button>
                                <ul class="dropdown-menu">
                                  <li><a class="dropdown-item" href="#">Action</a></li>
                                  <li><a class="dropdown-item" href="#">Another action</a></li>
                                  <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                              </div>
                            </div>
                          </div>




                </div>
                <div class="container__vector" >
                    <img src="images/nueva.png" alt="" >
                </div>
            </div>

        </div>
        <Footer>
            <div class="container__footer">

                <div class="box__footer">
                    <div class="logo">
                        <img src="images/nueva.png" alt="">
                    </div>
                    <div class="terms">
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Harum reiciendis et quasi aut facere vitae vero. Inventore, minus ab voluptate modi repellat, pariatur tempora quisquam, debitis facilis explicabo voluptatem. A.
                    </div>
                </div>

                <div class="box__footer">
                    <h2>Plataformas</h2>
                    <a href="#">Aula Virtual UES</a>
                    <a href="#">Expediente en Línea</a>
                    <a href="#">Expediente Móvil</a>
                </div>

                <div class="box__footer">
                    <h2>Medios de contacto</h2>
                    <a href="#"><i class="fab fa-facebook-square"></i> Facebook</a>
                    <a href="#"><i class="fa-solid fa-envelope"></i> academicafmo@ues.edu.sv</a>
                    <a href="#"><i class="fa-solid fa-phone"></i> 2664 - 0000</a>
                    <a href="#" class="ubicado"><i class="fa-solid fa-location-dot"></i> Km. 144 Carretera al Cuco, Cantón El Jute, San Miguel. El Salvador, Centro América.</a>
                </div>
            </div>

            <div class="box__copyright">
                <hr>
                <p>Todos los derechos reservados © 2024 <b>Académica FMO</b></p>
            </div>
        </Footer>

</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/principalWave.js"></script>
</body>
</html>