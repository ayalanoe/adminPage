@extends('Layouts.index') 

@section('titulo-publico', '- Directorio Académica')

@section('css-publico')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/principal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/directorioPublic.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tituloEncabezadoGlobal.css') }}">
@endsection

@section('contenido-publico')

    <div class="container_table">

            <div class="container">
                <h3>DIRECTORIO DE ADMINISTRACIÓN ACADÉMICA</h3>
                
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
@endsection