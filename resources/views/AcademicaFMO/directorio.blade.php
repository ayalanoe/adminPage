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
</body>
</html>