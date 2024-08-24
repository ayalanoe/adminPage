@extends('Layouts.index') 

@section('titulo-publico', '- Trámites Académicos')

@section('css-publico')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/styleNav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/formatoTablaCKEditor.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tituloEncabezadoGlobal.css') }}">

    <!-- Link de css para formato del CKEditor -->
    <link rel="stylesheet" href="{{ asset('css/formatoTablaCKEditor.css') }}">
@endsection

@section('contenido-publico')

    <div class="container margen-titulo">

        <div class="row justify-content-center mb-4">
            <div class="col-12">
                <h3 class="title-text text-center">{{ mb_strtoupper ($tramiteAcademico->tramite) }}</h3>
            </div>
        </div>

        <div class="container_table">

            <div class="container contenedor-tabla">
                {!! $tramiteAcademico->contenido !!}

                @if ($tramiteAcademico->rutaFormato)
                    <p>Descargar el formato del tramite</p>
                    <a href="{{ route('publicDescargarFormato', $tramiteAcademico->id) }}" class="btn btn-success mx-1"><i class="fa-solid fa-file-arrow-down"></i></a>
                @endif
            </div>   
            
        </div>

    </div>

@endsection 