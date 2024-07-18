@extends('Layouts.index') 

@section('titulo-publico', '- Catálogo Académico')

@section('css-publico')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/styleNav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tituloEncabezadoGlobal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cssPublic/catalogoAcademico.css') }}">
@endsection

@section('contenido-publico')

    <div class="container margen-titulo">

        <div class="row justify-content-center mb-4">
            <div class="col-12">
                <h3 class="title-text text-center">CATÁLOGO ACADÉMICO</h3>
            </div>
        </div>

        <div class="container_table">
            @if ($mostrarCatalogo->isEmpty())
                <div class="alert alert-success text-center">
                    No hay registro
                </div>
            @else

                <div class="row">
                    @foreach ($mostrarCatalogo as $catalogo)
                        <div class="col-sm-6 mb-3 mb-sm-0 mx-auto">
                            <div class="card custom-card">
                                <div class="card-body">
                                    <div class="title-container">
                                        <h5 class="card-title">{{$catalogo->titulo}}</h5>
                                    </div>
                                    <hr>
                                        <p class="card-text">{{$catalogo->descripcion}}</p>
                                        <a href="{{route('mostrarCatalogoPdf', $catalogo->id)}}" target="_blank" class="btn btn-ver">Ver el catálogo</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            @endif
        </div>

    </div

@endsection 