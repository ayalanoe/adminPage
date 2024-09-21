@extends('Layouts.index') 

@section('titulo-publico', '- Directorio de Facultad ')

@section('css-publico')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/styleNav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/directorioPublic.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tituloEncabezadoGlobal.css') }}">
@endsection

@section('contenido-publico')

    
    @php
        $facultades = [
            "FM" => "Facultad de Medicina",
            "FJJCCSS" => "Facultad de Jurisprudencia y Ciencias Sociales",
            "FCCAA" => "Facultad de Ciencias Agronómicas",
            "FCCHH" => "Facultad de Ciencias y Humanidades",
            "FIA" => "Facultad de Ingeniería y Arquitectura",
            "FQF" => "Facultad de Química y Farmacia",
            "FOUES" => "Facultad de Odontología",
            "FCCEE" => "Facultad de Ciencias Económicas",
            "FCIMAT" => "Facultad de Ciencias Naturales y Matemática",
            "FMOCC" => "Facultad Multidisciplinaria de Occidente",
            "FMO" => "Facultad Multidisciplinaria Oriente",
            "FMP" => "Facultad Multidisciplinaria Paracentral"
        ];

        $nombreFacultad = $facultades[$tituloFacultad] ?? "No encontrado";
    @endphp



    <div class="container margen-titulo">

        <div class="row justify-content-center mb-4">
            <div class="col-12">
                <h3 class="title-text text-center">DIRECTORIO ADMINISTRATIVO:</h3>
                <h3 class="title-text text-center">{{ mb_strtoupper($nombreFacultad) }}</h3>
            </div>
        </div>
        @if ($facultadDirectorio->isEmpty())
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
                                    <th scope="col">Oficina</th>
                                    <th scope="col">Correo Electrónico</th>
                                    <th scope="col">Contacto</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($facultadDirectorio as $contactoFacu)
                                    <tr> 
                                        <td> {{$contactoFacu->oficina}} </td>
                                        <td> {{$contactoFacu->correo}} </td>
                                        <td class="text-nowrap"> {{$contactoFacu->contacto}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
            
                    <!-- Card view for smaller screens -->
                    <div class="d-block d-md-none">
                        @foreach ($facultadDirectorio as $contactoFacu)
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Oficina: {{$contactoFacu->oficina}}</h5>
                                <p class="card-text"><strong>Correo Electrónico:</strong> {{$contactoFacu->correo}}</p>
                                <p class="card-text"><strong>Contacto:</strong> {{$contactoFacu->contacto}}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
        <br><br>
    </div>

@endsection