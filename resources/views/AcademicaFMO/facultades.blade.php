<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FACULTADES</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/directorioPublic.css') }}">
</head>
<body>
    <!--TABLA DE ELEMENTOS-->
    <div class="card border-0">
        <div class="card-header">
            <div class="container">
                <h2>DIRECTORIO</h2>
                <p>CONTACTOS DE ACADEMICA...</p>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Facultad</th>
                            <th scope="col">Correo Institucional</th>
                            <th scope="col">Contacto</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $numero = 1 
                        @endphp
                    
                        @foreach ($directorio as $facultadC)
                        <tr>
                            <th scope="row">{{$numero}}</th>  
                            <td>{{$facultadC->nombre}}</td>
                            <td>{{$facultadC->correo}}</td>
                            <td>{{$facultadC->contacto}}</td>
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