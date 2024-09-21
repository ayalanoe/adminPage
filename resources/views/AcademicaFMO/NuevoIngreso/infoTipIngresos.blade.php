@extends('Layouts.index') 

@section('titulo-publico', '- Tipos de Ingreso')

@section('css-publico')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/styleNav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tituloEncabezadoGlobal.css') }}">
@endsection

@section('contenido-publico')

    <div class="container margen-titulo">

        <div class="row justify-content-center mb-4">
            <div class="col-12">
                <h3 class="title-text text-center">{{mb_strtoupper($tipoDeIngreso->titulo)}}</h3>
            </div>
        </div>

        <div class="container_table">
            
            <div class="container">
                <p>
                    {{$tipoDeIngreso->descripcion}}
                </p>
    
                <img src="{{asset('storage/'.$tipoDeIngreso->rutaArchivo)}}" class="d-block mx-auto w-100" alt="...">
            </div>

        </div>

    </div>

@endsection 