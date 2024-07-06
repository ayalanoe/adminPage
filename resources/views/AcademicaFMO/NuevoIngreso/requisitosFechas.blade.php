@extends('Layouts.index') 

@section('titulo-publico', '- Requisitos y Fechas')

@section('css-publico')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/principal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tramitesPublic.css') }}">

    !-- Link de css para darle formato a la tabla que se crea con el CKeditor desde el admin -->
    <link rel="stylesheet" href="{{ asset('css/formatoTablaCKEditor.css') }}">
@endsection

@section('contenido-publico')
<div class="container_table">

    @if ($requisitosFecha->isEmpty())
        <div class="container">

            <h3>REQUISITOS Y FECHAS PARA APLICAR</h3>
            <hr>
            <div class="alert alert-success">
                No hay registro
            </div>

        </div>
    @else

        <div class="container">
            @foreach($requisitosFecha as $requisito)
            
                <h3>{{$requisito->titulo}}</h3>
                <hr>
                <p>{!! $requisito->contenido !!}</p>
                
            @endforeach
        </div>
        
    @endif

</div>

@endsection 