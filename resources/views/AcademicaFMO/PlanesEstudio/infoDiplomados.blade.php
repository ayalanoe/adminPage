@extends('Layouts.index') 

@section('titulo-publico', '- Diplomados detalles')

@section('css-publico')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/principal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tramitesPublic.css') }}">
     <link rel="stylesheet" href="{{ asset('css/tituloEncabezadoGlobal.css') }}">
@endsection

@section('contenido-publico')
    <div class="container_tablee">
        <h3 id="h">{{$diplomadoInfo->carrera}}</h3>
            <hr>
    </div>
    <div class="container_table">
        <div class="container">         
            <img src="{{asset('storage/'.$diplomadoInfo->rutaArchivo)}}" class="d-block w-100" alt="..."> 
        </div>
    </div>
@endsection 