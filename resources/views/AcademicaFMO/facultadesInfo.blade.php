@extends('Layouts.index') 

@section('titulo-publico', '- Directorio de Facultad ')

@section('css-publico')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/principal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/directorioPublic.css') }}">
@endsection

@section('contenido-publico')

    <div class="container_table">
        <!--TABLA DE ELEMENTOS-->

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

        <div class="container">
            <h3>Directorio administrativo: {{$nombreFacultad}}</h3>
                
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Oficina</th>
                        <th scope="col">Correo Electrónico</th>
                        <th scope="col">Contacto</th>
                    </tr>
                </thead>
                <tbody>

                    @php
                        $numero = 1 
                    @endphp

                    @foreach ($facultadDirectorio as $contactoFacu)
                        <tr>
                            <th scope="row"> {{$numero}} </th>  
                            <td> {{$contactoFacu->oficina}} </td>
                            <td> {{$contactoFacu->correo}} </td>
                            <td> {{$contactoFacu->contacto}} </td>
                        </tr>

                        @php
                            $numero++
                        @endphp

                    @endforeach
                </tbody>
                </table>
                
                
        </div>
    </div>
@endsection