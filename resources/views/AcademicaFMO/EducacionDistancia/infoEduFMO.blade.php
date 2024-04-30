@extends('Layouts.index') 

@section('titulo-publico', '- Educación a Distancia FMO')

@section('css-publico')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/principal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tramitesPublic.css') }}">
@endsection

@section('contenido-publico')
    <div class="container_table">
        <div class="container">
            <h3> nombre carrera aqui </h3>
            <hr>
            <p>
                Contenido de carrera aqui
            </p>
            <p>Descargar Plan de Estudio:</p>
            <a href=" " class="btn btn-success mx-1"><i class="fa-solid fa-file-arrow-down"></i></a>
        </div>
    </div>
@endsection 