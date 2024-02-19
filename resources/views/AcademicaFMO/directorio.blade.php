<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/directorioPublic.css') }}">
</head>
<body>
    <!--TABLA DE ELEMENTOS-->
    <div class="card border-0">
        <div class="card-header">
            <h5 class="card-tittle">
                BIENVENIDO AL DIRECTORIO
            </h5>
                
            <div class="container">
                <h2>DIRECTORIO</h2>
                <p>CONTACTOS DE ACADEMICA...</p>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Encargado</th>
                            <th scope="col">Correo Electrónico</th>
                            <th scope="col">Contacto</th>
                            <th scope="col">Trámites a cargo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $numero = 1 
                        @endphp
                    
                        @foreach ($directorio as $contacto)
                        <tr>
                            <th scope="row">{{$numero}}</th>  
                            <td>{{$contacto->nombre}}</td>
                            <td>{{$contacto->correo}}</td>
                            <td>{{$contacto->contacto}}</td>
                            <td>{{$contacto->tramitesAsignado}}</td>
                        </tr>
                        @php
                            $numero++
                        @endphp
                        @endforeach
                        </tbody>
                </table>
            </div>
        </div>

        <div class="card-body">
        </div>
        
    </div>

    <div id="carouselExampleCaptions" class="carousel slide">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="https://img.freepik.com/vector-gratis/desarrollo-web-ingenieria-programadores-sitio-web-codificacion-pantallas-interfaz-realidad-aumentada-desarrollador-ingeniero-proyectos-software-programacion-o-diseno-aplicaciones-ilustracion-dibujos-animados_107791-3863.jpg?size=626&ext=jpg&ga=GA1.1.1687694167.1704326400&semt=ais" class="d-block w-100" alt="mur">
            <div class="carousel-caption d-none d-md-block">
              <h5>First slide label</h5>
              <p>Some representative placeholder content for the first slide.</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="https://www.google.com/imgres?imgurl=https%3A%2F%2Fassets.bitdegree.org%2Fonline-learning-platforms%2Fstorage%2Fmedia%2F2018%2F08%2Fwhat-is-a-web-developer.jpg&tbnid=2z-F6YKVtXFoMM&vet=12ahUKEwjE2ND4zbaEAxWqDWIAHYjVCJ8QMygEegQIARB7..i&imgrefurl=https%3A%2F%2Fwww.bitdegree.org%2Ftutorials%2Fwhat-is-a-web-developer%2F&docid=VNoxLsAMiI0sdM&w=900&h=560&q=imagenes%20de%20dev%20web&ved=2ahUKEwjE2ND4zbaEAxWqDWIAHYjVCJ8QMygEegQIARB7" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>Second slide label</h5>
              <p>Some representative placeholder content for the second slide.</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="https://www.google.com/url?sa=i&url=https%3A%2F%2Ftumo.org%2Fproject%2Fwebdevelopment%2F&psig=AOvVaw0YwFj0uaMXl5HO85hJFM-0&ust=1708404794690000&source=images&cd=vfe&opi=89978449&ved=0CBIQjRxqFwoTCPj6_vrNtoQDFQAAAAAdAAAAABAH" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>Third slide label</h5>
              <p>Some representative placeholder content for the third slide.</p>
            </div>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
</body>
</html>