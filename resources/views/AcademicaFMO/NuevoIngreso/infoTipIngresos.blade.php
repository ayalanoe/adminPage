@extends('Layouts.index') 

@section('titulo-publico', '- Tipos de Ingreso')

@section('css-publico')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/principal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tramitesPublic.css') }}">
@endsection

@section('contenido-publico')
    <div class="container_table">

        <div class="container">
            <h3>{{$tipoDeIngreso->titulo}}</h3>
            <hr>
            <p>
                {{$tipoDeIngreso->descripcion}}
            </p>

            <img src="{{asset('storage/'.$tipoDeIngreso->rutaArchivo)}}" class="d-block w-100" alt="...">

            
        </div>
    </div>

@endsection 