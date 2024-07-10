@extends('Layouts.index') 

@section('titulo-publico', '- Trámites Académicos')

@section('css-publico')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/principal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tramitesPublic.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tituloEncabezadoGlobal.css') }}">

    <!-- Link de css para darle formato a la tabla que se crea con el CKeditor desde el admin -->
    <link rel="stylesheet" href="{{ asset('css/formatoTablaCKEditor.css') }}">
@endsection

@section('contenido-publico')

<div class="container_tablee">
    <h3 id="h"> {{$tramiteAcademico->tramite}}</h3>
  </div>
<div class="container_table">
    <!--TABLA DE ELEMENTOS-->

        <div class="container">

            <div>
                {!! $tramiteAcademico->contenido !!}
            </div>
            

            @if ($tramiteAcademico->rutaFormato)
                <p>Descargar el formato del tramite</p>
                <a href="{{ route('publicDescargarFormato', $tramiteAcademico->id) }}" class="btn btn-success mx-1"><i class="fa-solid fa-file-arrow-down"></i></a>
            @endif
            
        </div>
</div>



@endsection 