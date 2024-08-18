@extends('Layouts.index') 

@section('titulo-publico', '- Directorio Académica')

@section('css-publico')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/styleNav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/directorioPublic.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tituloEncabezadoGlobal.css') }}">
@endsection

@section('contenido-publico')

<div class="container margen-titulo">

    <div class="row justify-content-center mb-4">
        <div class="col-12">
            <h3 class="title-text text-center">DIRECTORIO ADMINISTRATIVO</h3>
        </div>
    </div>
    @if ($directorio->isEmpty())
        <div class="alert alert-success text-center">
            El directorio no ha sido publicado.
        </div>
        <br><br><br><br><br>
    @else
        <div class="container_table my-4">
            <div class="container">
                <div class="d-none d-md-block">
                    <table class="table table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Encargado</th>
                                <th scope="col">Correo Electrónico</th>
                                <th scope="col">Contacto</th>
                                <th scope="col">Trámites a cargo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($directorio as $contacto)
                            <tr>
                                <td>{{$contacto->nombre}}</td>
                                <td>{{$contacto->correo}}</td>
                                <td class="text-nowrap">{{$contacto->contacto}}</td>
                                <td>{{$contacto->tramitesAsignado}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
        
                <!-- Card view for smaller screens -->
                <div class="d-block d-md-none">
                    @foreach ($directorio as $contacto)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Encargado: {{$contacto->nombre}}</h5>
                            <p class="card-text"><strong>Correo Electrónico:</strong> {{$contacto->correo}}</p>
                            <p class="card-text"><strong>Contacto:</strong> {{$contacto->contacto}}</p>
                            <p class="card-text"><strong>Trámites a cargo:</strong> {{$contacto->tramitesAsignado}}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    <br>
</div>

@endsection