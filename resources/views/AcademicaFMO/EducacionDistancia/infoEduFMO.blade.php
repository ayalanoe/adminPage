@extends('Layouts.index') 

@section('titulo-publico', '- Educación a Distancia FMO')

@section('css-publico')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/principal.css') }}">

    <link rel="stylesheet" href="{{ asset('css/tituloEncabezadoGlobal.css') }}">

    <!-- Link de css para darle formato a la tabla que se crea con el CKeditor desde el admin -->
    <link rel="stylesheet" href="{{ asset('css/formatoTablaCKEditor.css') }}">
@endsection

@section('contenido-publico')
<div class="container_tablee">
    <h3 id="h">{{ mb_strtoupper($datosCarDisFmo->carrera) }}</h3>
</div>
    <div class="container_table">
        <div class="container">

            @if (!$datosCarDisFmo)
                {{abort(404)}}
            @endif
            <div>
                {!! $datosCarDisFmo->contenido !!}
            </div>
            <p>Ver informacion</p>
            <a href="{{route('mostrarPdfCarDisFmo', $datosCarDisFmo->id) }}" class="btn btn-secondary mx-1" target="_blank"><i class="fa-solid fa-eye"></i></a>
        </div>
    </div>
@endsection 