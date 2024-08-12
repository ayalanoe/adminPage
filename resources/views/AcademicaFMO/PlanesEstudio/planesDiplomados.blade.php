@extends('Layouts.index') 

@section('titulo-publico', ' - Diplomados')

@section('css-publico')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/styleNav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cssPublic/PlanesStyle/diplomados.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tituloEncabezadoGlobal.css') }}">
@endsection

@section('contenido-publico')

    <div class="container margen-titulo">

        <div class="row justify-content-center mb-4">
            <div class="col-12">
                <h3 class="title-text text-center">DIPLOMADOS</h3>
            </div>
        </div>

        <div class="container_table">

            @if ($diplomadosPlanes->isEmpty())
                <div class="alert alert-success text-center">
                    No hay registro
                </div>
                <br><br><br><br><br><br>
            @else 
                <div class="container">          
                    <div class="row">
                        @foreach ($diplomadosPlanes as $diplomado)
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <div class="card custom-card">
                                    <div class="card-body">
                                        <div class="title-container">
                                            <h5 class="card-title">{{$diplomado->carrera}}</h5>
                                        </div>
                                        <hr class="hr-diplomado">
                                        <a href="{{ route('verInfoDiplomado', $diplomado->id) }}" class="btn btn-ver">Más detalles</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach 
                    </div>
                </div>

                <br><br><br>
            @endif

        </div>

    </div>

        
@endsection




