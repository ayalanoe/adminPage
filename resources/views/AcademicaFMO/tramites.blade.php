@extends('Layouts.index') 

@section('titulo-publico', '- Trámites Académicos')

@section('css-publico')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/principal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tramitesPublic.css') }}">
@endsection

@section('contenido-publico')
<div class="container_table">
    <!--TABLA DE ELEMENTOS-->

        <div class="container">
            <h3> {{$tramiteAcademico->tramite}} </h3>
            <hr>
            <p>
                {!! $tramiteAcademico->contenido !!}
            </p>

            @if ($tramiteAcademico->rutaFormato)
                <p>Descargar el formato del tramite</p>
                <a href="#" class="btn btn-success mx-1"><i class="fa-solid fa-file-arrow-down"></i></a>
            @endif
            
        </div>
</div>

@endsection 